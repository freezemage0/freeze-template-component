<?php

declare(strict_types=1);

namespace Freeze\Component\Template\Compiler;

use Freeze\Component\Template\Context;
use Freeze\Component\Template\Contract\NodeCompilerInterface;
use Freeze\Component\Template\Contract\NodeInterface;
use Freeze\Component\Template\Node\PlainText;

final class PlainTextCompiler implements NodeCompilerInterface
{
    public function compile(NodeInterface $node, Context $context): ?string
    {
        return ($node instanceof PlainText) ? $node->content : null;
    }
}
