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

use ArrayAccess;
use Hyperf\Utils\Collection;
use HyperfTest\HyperfCollectionMacros\TestCase;

/**
 * @internal
 * @coversNothing
 */
class PluckManyTest extends TestCase
{
    /** @test */
    public function itProvidesAPluckManyMacro()
    {
        $this->assertTrue(Collection::hasMacro('pluckMany'));
    }

    /** @test */
    public function itCanPluckFromACollectionOfCollections()
    {
        $data = Collection::make([
            collect(['id' => 1, 'name' => 'matt', 'hobby' => 'coding']),
            collect(['id' => 2, 'name' => 'tomo', 'hobby' => 'cooking']),
        ]);

        $this->assertEquals($data->map->only(['name', 'hobby']), $data->pluckMany(['name', 'hobby']));
    }

    /** @test */
    public function itCanPluckFromArrayAndObjectItems()
    {
        $data = Collection::make([
            (object) ['id' => 1, 'name' => 'matt', 'hobby' => 'coding'],
            ['id' => 2, 'name' => 'tomo', 'hobby' => 'cooking'],
        ]);

        $this->assertEquals(
            [
                (object) ['name' => 'matt', 'hobby' => 'coding'],
                ['name' => 'tomo', 'hobby' => 'cooking'],
            ],
            $data->pluckMany(['name', 'hobby'])->all()
        );
    }

    /** @test */
    public function itCanPluckFromObjectsThatImplementArrayAccessInterface()
    {
        $data = Collection::make([
            new TestArrayAccessImplementation(['id' => 1, 'name' => 'marco', 'hobby' => 'drinking']),
            new TestArrayAccessImplementation(['id' => 2, 'name' => 'belle', 'hobby' => 'cross-stitch']),
        ]);

        $this->assertEquals(
            [
                ['name' => 'marco', 'hobby' => 'drinking'],
                ['name' => 'belle', 'hobby' => 'cross-stitch'],
            ],
            $data->pluckMany(['name', 'hobby'])->all()
        );
    }
}

class TestArrayAccessImplementation implements ArrayAccess
{
    private $arr;

    public function __construct($arr)
    {
        $this->arr = $arr;
    }

    public function offsetExists($offset)
    {
        return isset($this->arr[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->arr[$offset];
    }

    public function offsetSet($offset, $value)
    {
        $this->arr[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        unset($this->arr[$offset]);
    }
}
