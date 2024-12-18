<?php

declare(strict_types=1);

namespace Freeze\Component\Template\Parser;

use Freeze\Component\Template\Contract\NodeInterface;
use Freeze\Component\Template\Contract\NodeParserInterface;
use Freeze\Component\Template\Node\PrintNode;

final class PrintParser implements NodeParserInterface
{
    const PRINT_PATTERN = '^\s*(?<unsafe>u)?print\s*(?<variable>.+)\s*$';

    public function getPattern(): string
    {
        return PrintParser::PRINT_PATTERN;
    }

    public function getName(): string
    {
        return 'print';
    }

    public function create(array $arguments): NodeInterface
    {
        return new PrintNode(
            $arguments['variable'],
            isset($arguments['unsafe']) && \strtolower($arguments['unsafe']) === 'u'
        );
    }
}
