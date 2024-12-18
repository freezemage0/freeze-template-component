<?php

declare(strict_types=1);

namespace Freeze\Component\Template\Compiler;

use Freeze\Component\Template\Context;
use Freeze\Component\Template\Contract\NodeCompilerInterface;
use Freeze\Component\Template\Contract\NodeInterface;
use Freeze\Component\Template\Node\Inject;

final class InjectCompiler implements NodeCompilerInterface
{
    public function compile(NodeInterface $node, Context $context): ?string
    {
        if (!($node instanceof Inject)) {
            return null;
        }


    }
}
