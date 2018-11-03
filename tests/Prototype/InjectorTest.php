<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

namespace Spiral\Prototype\Tests;

use PHPUnit\Framework\TestCase;
use Spiral\Prototype\Injector;
use Spiral\Prototype\Tests\Fixtures\TestClass;

class InjectorTest extends TestCase
{
    public function setUp()
    {
        if (ini_get('zend.assertions') == 1) {
            ini_set('zend.assertions', 0);
        }
    }

    public function testSimpleInjection()
    {
        $i = new Injector();

        $r = $i->injectDependencies(
            file_get_contents(__DIR__ . '/Fixtures/TestClass.php'),
            ['testClass' => TestClass::class]
        );

        $this->assertContains(TestClass::class, $r);
    }

    public function testModifyConstructor()
    {
        $i = new Injector();

        $r = $i->injectDependencies(
            file_get_contents(__DIR__ . '/Fixtures/WithConstructor.php'),
            ['testClass' => TestClass::class]
        );

        $this->assertContains('@param HydratedClass $h', $r);
        $this->assertContains('@param TestClass $testClass', $r);
    }
}