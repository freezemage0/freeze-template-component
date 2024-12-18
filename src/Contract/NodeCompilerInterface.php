<?php

declare(strict_types=1);

namespace Freeze\Component\Template\Contract;

use Freeze\Component\Template\Context;

interface NodeCompilerInterface
{
    public function compile(NodeInterface $node, Context $context): ?string;
}
