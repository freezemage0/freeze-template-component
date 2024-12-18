<?php

declare(strict_types=1);

namespace Freeze\Component\Template\Node;

use Freeze\Component\Template\Contract\NodeInterface;

final class PlainText implements NodeInterface
{
    public function __construct(
        public string $content = ''
    ) {
    }
}
