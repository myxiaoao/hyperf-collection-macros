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
class InsertBeforeKeyTest extends TestCase
{
    /** @test */
    public function itProvidesAnInsertBeforeKeyMacro()
    {
        $this->assertTrue(Collection::hasMacro('insertBeforeKey'));
    }

    /** @test */
    public function itInsertsWithUnkeyedArray()
    {
        $collection = Collection::make(['zero', 'two', 'three']);
        $collection->insertBeforeKey(1, 'one');
        $this->assertEquals(json_encode(['zero', 'one', 'two', 'three']), json_encode($collection->toArray()));
    }

    /** @test */
    public function itReturnsTheUpdatedCollection()
    {
        $collection = Collection::make(['zero', 'two', 'three'])->insertBeforeKey(1, 'one');
        $this->assertEquals(
            json_encode(['zero', 'one', 'two', 'three']),
            json_encode($collection->toArray())
        );
    }

    /** @test */
    public function itMaintainsArrayKeys()
    {
        $collection = Collection::make(['zero' => 0, 'two' => 2, 'three' => 3])->insertBeforeKey('two', 'one');
        $this->assertEquals(
            json_encode(['zero' => 0, 'one', 'two' => 2, 'three' => 3]),
            json_encode($collection->toArray())
        );
    }

    /** @test */
    public function itInsertsWithAKey()
    {
        $collection = Collection::make(['zero' => 0, 'two' => 2, 'three' => 3])->insertBeforeKey('two', 5, 'five');
        $this->assertEquals(
            json_encode(['zero' => 0, 'five' => 5, 'two' => 2, 'three' => 3]),
            json_encode($collection->toArray())
        );
    }
}
