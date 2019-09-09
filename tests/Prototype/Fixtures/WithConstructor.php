<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

namespace Spiral\Prototype\Tests\Fixtures;

class WithConstructor
{
    /**
     * @var HydratedClass
     */
    private $hydrated;

    /**
     * @param HydratedClass $h
     */
    public function __construct(HydratedClass $h)
    {
        $this->hydrated = $h;
    }

    public function getHydrated(): HydratedClass
    {
        return $this->hydrated;
    }

    public function getTestClass(): TestClass
    {
        return $this->testClass;
    }
}
