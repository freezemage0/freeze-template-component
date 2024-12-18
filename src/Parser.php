<?php

declare(strict_types=1);

namespace Freeze\Component\Template;

use Freeze\Component\Template\Contract\NodeInterface;
use Freeze\Component\Template\Contract\NodeParserInterface;
use Freeze\Component\Template\Node\PlainText;
use Freeze\Component\Template\Node\PrintNode;
use Freeze\Component\Template\Node\Tree;
use Freeze\Component\Template\Parser\ImportParser;
use RuntimeException;

final class Parser
{
    private const INSTRUCTION_MARKER = '*';

    private int $position = 0;
    private string $text = '';
    private int $length = 0;
    private ?string $nodePattern = null;
    private array $nodeParsers;

    public function __construct(NodeParserInterface ...$nodeParsers)
    {
        $this->nodeParsers = $nodeParsers;
    }

    public function parse(string $text): Tree
    {
        $this->text = $text;
        $this->length = \strlen($text);

        $tree = new Tree();
        $plainText = new PlainText();

        for ($this->position = 0; $this->position < $this->length; $this->position += 1) {
            $symbol = $text[$this->position];

            if ($symbol === Parser::INSTRUCTION_MARKER) {
                $tree->append($plainText);
                $tree->append($this->parseNode());

                $plainText = new PlainText();
            } else {
                $plainText->content .= $symbol;
            }
        }

        $tree->append($plainText);

        return $tree;
    }

    private function parseNode(): NodeInterface
    {
        $buffer = '';
        do {
            $this->position += 1;
            $symbol = $this->text[$this->position];

            if ($symbol === Parser::INSTRUCTION_MARKER) {
                $isEscaped = ($this->text[$this->position - 1] ?? null) === '\\';

                if ($isEscaped) {
                    continue; // Remove escaped part
                }

                break; // Statement is complete
            }

            $buffer .= $symbol;
        } while ($this->position < $this->length);

        $buffer = \trim($buffer);

        if (!\preg_match($this->buildNodeParserPattern(), $buffer, $matches)) {
            throw new RuntimeException("Invalid node syntax: {$buffer}");
        }

        foreach ($this->nodeParsers as $parser) {
            if (!empty($matches[$parser->getName()])) {
                return $parser->create($matches);
            }
        }

        throw new RuntimeException("Unknown node");
    }

    private function buildNodeParserPattern(): string
    {
        if (isset($this->nodePattern)) {
            return $this->nodePattern;
        }

        $patterns = [];
        foreach ($this->nodeParsers as $parser) {
            $patterns[] = "(?<{$parser->getName()}>{$parser->getPattern()})";
        }

        return $this->nodePattern = '/' . \implode('|', $patterns) . '/iuJ';
    }
}
