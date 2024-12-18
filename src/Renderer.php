<?php

declare(strict_types=1);

namespace Freeze\Component\Template;

final class Renderer
{
    public function __construct(
        private readonly Parser $parser,
        private readonly Compiler $compiler
    ) {
    }

    public function render(string $templatePath, Context $context = new Context()): string
    {
        $content = \file_get_contents($templatePath);
        $tree = $this->parser->parse($content);

        return $this->compiler->compile($tree, $context);
    }
}
