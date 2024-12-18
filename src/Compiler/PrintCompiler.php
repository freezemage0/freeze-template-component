<?php

declare(strict_types=1);

namespace Freeze\Component\Template\Compiler;

use Freeze\Component\Template\Context;
use Freeze\Component\Template\Contract\NodeCompilerInterface;
use Freeze\Component\Template\Contract\NodeInterface;
use Freeze\Component\Template\Node\PrintNode;

final class PrintCompiler implements NodeCompilerInterface
{
    public function compile(NodeInterface $node, Context $context): ?string
    {
        if (!($node instanceof PrintNode)) {
            return null;
        }

        $content = $context->get($node->content);
        if (!$node->unsafe) {
            $content = \htmlspecialchars($content);
        }

        return $content;
    }
}
