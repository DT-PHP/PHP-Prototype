<?php

declare(strict_types=1);

/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

namespace Spiral\Prototype\Tests;

use PHPUnit\Framework\TestCase;
use Spiral\Prototype\PrototypeLocator;
use Spiral\Prototype\Tests\Fixtures\HydratedClass;
use Spiral\Prototype\Tests\Fixtures\TestClass;
use Spiral\Tokenizer\ClassesInterface;
use Spiral\Tokenizer\ClassLocator;
use Symfony\Component\Finder\Finder;

class LocatorTest extends TestCase
{
    public function testLocate(): void
    {
        $classes = $this->makeClasses();
        $l = new PrototypeLocator($classes);

        $this->assertArrayHasKey(TestClass::class, $l->getTargetClasses());
    }

    public function testLocateNot(): void
    {
        $classes = $this->makeClasses();
        $l = new PrototypeLocator($classes);

        $this->assertArrayNotHasKey(HydratedClass::class, $l->getTargetClasses());
    }

    private function makeClasses(): ClassesInterface
    {
        return new ClassLocator(
            (new Finder())->in([__DIR__ . '/Fixtures'])->files()
        );
    }
}
