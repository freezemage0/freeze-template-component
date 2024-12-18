<?php

declare(strict_types=1);

namespace Freeze\Component\Template\Node;

use Freeze\Component\Template\Contract\NodeInterface;

final class FunctionNode implements NodeInterface
{
    public function __construct(
        public readonly string $name,
        public readonly array $arguments
    ) {
    }
}
