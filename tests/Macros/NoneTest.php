<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace HyperfTest\HyperfCollectionMacros\Macros;

use Hyperf\Utils\Collection;
use HyperfTest\HyperfCollectionMacros\TestCase;

/**
 * @internal
 * @coversNothing
 */
class NoneTest extends TestCase
{
    /** @test */
    public function itCanCheckIfAnItemIsntPresentInACollection()
    {
        $this->assertTrue(Collection::make(['foo'])->none('bar'));
        $this->assertFalse(Collection::make(['foo'])->none('foo'));
    }

    /** @test */
    public function itCanCheckIfAKeyValuePairIsntPresentInACollection()
    {
        $this->assertTrue(Collection::make([['name' => 'foo']])->none('name', 'bar'));
        $this->assertFalse(Collection::make([['name' => 'foo']])->none('name', 'foo'));
    }

    /** @test */
    public function itCanCheckIfSomethingIsntPresentInACollectionWithATruthTest()
    {
        $this->assertTrue(Collection::make(['name' => 'foo'])->none(function ($value, $key) {
            return $key === 'name' && $value === 'bar';
        }));

        $this->assertFalse(Collection::make(['name' => 'foo'])->none(function ($value, $key) {
            return $key === 'name' && $value === 'foo';
        }));
    }
}
