<?php

declare(strict_types=1);

namespace Freeze\Component\Template\Parser;

use Freeze\Component\Template\Contract\NodeInterface;
use Freeze\Component\Template\Contract\NodeParserInterface;
use Freeze\Component\Template\Node\Import;

final class ImportParser implements NodeParserInterface
{
    private const NODE_PATTERN = '^\s*import\s*[\"\'](?<template>.+)[\"\']\s*$';

    public function create(array $arguments): NodeInterface
    {
        return new Import($arguments['template']);
    }

    public function getPattern(): string
    {
        return ImportParser::NODE_PATTERN;
    }

    public function getName(): string
    {
        return 'import';
    }
}
