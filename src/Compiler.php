<?php

declare(strict_types=1);

namespace Freeze\Component\Template;

use Freeze\Component\Template\Contract\NodeCompilerInterface;
use Freeze\Component\Template\Contract\NodeInterface;

final class Compiler implements NodeCompilerInterface
{
    /** @var array<NodeCompilerInterface> */
    private array $nodeCompilers = [];

    public function registerNodeCompiler(NodeCompilerInterface $nodeCompiler): void
    {
        $this->nodeCompilers[] = $nodeCompiler;
    }

    public function compile(NodeInterface $node, Context $context): ?string
    {
        $content = '';
        foreach ($this->nodeCompilers as $nodeCompiler) {
            $nodeContent = $nodeCompiler->compile($node, $context);
            if ($nodeContent === null) {
                continue;
            }
            $content .= $nodeContent;
        }

        return $content;
    }
}
