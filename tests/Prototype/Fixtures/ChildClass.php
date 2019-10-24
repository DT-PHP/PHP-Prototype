<?php

/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

declare(strict_types=1);

namespace Spiral\Prototype\Tests\Fixtures;

use Spiral\Prototype\Traits\PrototypeTrait;

class ChildClass extends WithConstructor
{
    use PrototypeTrait;

    public function testMe()
    {
        return $this->testClass;
    }

    public function method(): void
    {
        $test2 = $this->test2;
        $test3 = $this->test3;
        $test = $this->test;
    }
}
