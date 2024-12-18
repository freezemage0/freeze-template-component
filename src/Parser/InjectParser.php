<?php

declare(strict_types=1);

namespace Freeze\Component\Template\Parser;

use Freeze\Component\Template\Contract\NodeInterface;
use Freeze\Component\Template\Contract\NodeParserInterface;
use Freeze\Component\Template\Node\Inject;

final class InjectParser implements NodeParserInterface
{
    public function getPattern(): string
    {
        return "^\s*inject\s*(['\"])(?<placeholder>.+)(\1)\s*$";
    }

    public function getName(): string
    {
        return 'inject';
    }

    public function create(array $arguments): NodeInterface
    {
        return new Inject($arguments['placeholder']);
    }
}
