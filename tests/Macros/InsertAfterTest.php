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
class InsertAfterTest extends TestCase
{
    /** @test */
    public function itProvidesAnInsertAfterMacro()
    {
        $this->assertTrue(Collection::hasMacro('insertAfter'));
    }

    /** @test */
    public function itInsertsAtTheCorrectIndex()
    {
        $collection = Collection::make(['zero', 'two', 'three']);
        $collection->insertAfter('zero', 'one');
        $this->assertEquals(json_encode(['zero', 'one', 'two', 'three']), json_encode($collection->toArray()));
    }

    /** @test */
    public function itReturnsTheUpdatedCollection()
    {
        $collection = Collection::make(['zero', 'two', 'three'])->insertAfter('zero', 'one');
        $this->assertEquals(
            json_encode(['zero', 'one', 'two', 'three']),
            json_encode($collection->toArray())
        );
    }

    /** @test */
    public function itMaintainsArrayKeys()
    {
        $collection = Collection::make(['zero' => 0, 'two' => 2, 'three' => 3])->insertAfter(0, 'one');
        $this->assertEquals(
            json_encode(['zero' => 0, 'one', 'two' => 2, 'three' => 3]),
            json_encode($collection->toArray())
        );
    }

    /** @test */
    public function itInsertsWithAKey()
    {
        $collection = Collection::make(['zero' => 0, 'two' => 2, 'three' => 3])->insertAfter(0, 5, 'five');
        $this->assertEquals(
            json_encode(['zero' => 0, 'five' => 5, 'two' => 2, 'three' => 3]),
            json_encode($collection->toArray())
        );
    }

    /** @test */
    public function itInsertsAtTheEndOfTheArray()
    {
        $collection = Collection::make(['one', 'two'])->insertAfter('two', 'three');
        $this->assertEquals(
            json_encode(['one', 'two', 'three']),
            json_encode($collection->toArray())
        );
    }
}
