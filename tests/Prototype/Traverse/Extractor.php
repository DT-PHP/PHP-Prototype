<?php

/**
 * Spiral Framework.
 *
 * @license MIT
 * @author  Valentin V (vvval)
 */
declare(strict_types=1);

namespace Spiral\Prototype\Tests\Traverse;

use PhpParser\NodeTraverser;
use PhpParser\NodeVisitor;
use PhpParser\ParserFactory;
use Spiral\Prototype\Annotation\Parser;

class Extractor
{
    /** @var Parser */
    private $parser;

    public function __construct(Parser $parser = null)
    {
        $this->parser = $parser ?? (new ParserFactory())->create(ParserFactory::ONLY_PHP7);
    }

    /**
     * @param string $filename
     * @return array
     */
    public function extractFromFilename(string $filename): array
    {
        $params = new ConstructorParamsVisitor();
        $this->traverse(file_get_contents($filename), $params);

        return $params->getParams();
    }

    /**
     * @param string $code
     * @return array
     */
    public function extractFromString(string $code): array
    {
        $params = new ConstructorParamsVisitor();
        $this->traverse($code, $params);

        return $params->getParams();
    }

    /**
     * @param string      $code
     * @param NodeVisitor ...$visitors
     */
    private function traverse(string $code, NodeVisitor ...$visitors): void
    {
        $tr = new NodeTraverser();
        foreach ($visitors as $visitor) {
            $tr->addVisitor($visitor);
        }

        $tr->traverse($this->parser->parse($code));
    }
}
