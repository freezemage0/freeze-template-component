<?php

declare(strict_types=1);

namespace Freeze\Component\Template\Compiler;

use Freeze\Component\Template\Compiler;
use Freeze\Component\Template\Context;
use Freeze\Component\Template\Contract\NodeCompilerInterface;
use Freeze\Component\Template\Contract\NodeInterface;
use Freeze\Component\Template\Node\Tree;

final class TreeCompiler implements NodeCompilerInterface
{
    public function __construct(
        private readonly Compiler $compiler
    ) {
    }

    public function compile(NodeInterface $node, Context $context): ?string
    {
        if (!($node instanceof Tree)) {
            return null;
        }

        $content = '';
        foreach ($node->getNodes() as $leaf) {
            $content .= $this->compiler->compile($leaf, $context);
        }

        return $content;
    }
}
