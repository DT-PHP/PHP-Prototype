<?php

namespace Spiral\Prototype\Tests\ClassNode\ConflictResolver\Fixtures;

class Params
{
    /**
     * @param string $method
     *
     * @return \ReflectionParameter[]
     */
    public static function getParams(string $method): array
    {
        try {
            $rc = new \ReflectionClass(self::class);
            $method = $rc->getMethod($method);

            return $method->getParameters();
        } catch (\ReflectionException $e) {
            return [];
        }
    }

    private function paramsSource(Test $t1, Test $t4, ?TestAlias $a1, SubFolder\Test $st = null, string $str = 'value')
    {
    }

    private function paramsSource2(Test $t1, Test $t4, ?TestAlias $a1, SubFolder\Test $st = null, string $t2 = 'value')
    {
    }

    private function paramsSource3(Test $t, Test $t4, ?TestAlias $a1, SubFolder\Test $st = null)
    {
    }
}