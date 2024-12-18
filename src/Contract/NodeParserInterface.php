<?php

declare(strict_types=1);

namespace Freeze\Component\Template\Contract;

interface NodeParserInterface
{
    public function getPattern(): string;

    public function getName(): string;

    public function create(array $arguments): NodeInterface;
}
