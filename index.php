<?php

declare(strict_types=1);


use Freeze\Component\Template\Compiler;
use Freeze\Component\Template\Compiler\InjectCompiler;
use Freeze\Component\Template\Compiler\PlainTextCompiler;
use Freeze\Component\Template\Compiler\PrintCompiler;
use Freeze\Component\Template\Compiler\TreeCompiler;
use Freeze\Component\Template\Context;
use Freeze\Component\Template\Parser;
use Freeze\Component\Template\Parser\ImportParser;
use Freeze\Component\Template\Parser\InjectParser;
use Freeze\Component\Template\Parser\PrintParser;
use Freeze\Component\Template\Renderer;

require __DIR__ . '/vendor/autoload.php';

$parser = new Parser(
    new ImportParser(),
    new InjectParser(),
    new PrintParser()
);

$compiler = new Compiler();
$compiler->registerNodeCompiler(new TreeCompiler($compiler));
$compiler->registerNodeCompiler(new InjectCompiler());
$compiler->registerNodeCompiler(new PrintCompiler());
$compiler->registerNodeCompiler(new PlainTextCompiler());

$context = new Context();
$context->set('title', 'Asdf');


$renderer = new Renderer($parser, $compiler);
$renderer->render(__DIR__ . '/example/header.freeze');
