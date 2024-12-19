<?php

declare(strict_types=1);

namespace Freeze\Component\Template\Parser;

use Freeze\Component\Template\Contract\NodeInterface;
use Freeze\Component\Template\Contract\NodeParserInterface;

final class PlaceholderParser implements NodeParserInterface
{
    public function getPattern(): string
    {
        return "^\s*placeholder\s*([\"'])(?<name>.+)(\1)\s*$";
    }

    public function getName(): string
    {
        return 'placeholder';
    }

    public function create(array $arguments): NodeInterface
    {

    }
}
