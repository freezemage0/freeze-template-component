<?php

declare(strict_types=1);

namespace Freeze\Component\Template\Node;

use Freeze\Component\Template\Contract\NodeInterface;

final class Tree implements NodeInterface
{
    /** @var array<NodeInterface> */
    private array $nodes = [];

    public function append(NodeInterface $node): void
    {
        $this->nodes[] = $node;
    }

    public function getNodes(): array
    {
        return $this->nodes;
    }
}
