<?php

declare(strict_types=1);
/**
 * This file is part of cooper/hyperf-collection-macros.
 *
 * @link     https://github.com/myxiaoao/hyperf-collection-macros
 * @document https://github.com/myxiaoao/hyperf-collection-macros/blob/master/README.md
 * @contact  myxiaoao@gmail.com
 * @license  https://github.com/myxiaoao/hyperf-collection-macros/blob/master/LICENSE
 */
namespace HyperfTest\HyperfCollectionMacros\Macros;

use Hyperf\Utils\Collection;
use HyperfTest\HyperfCollectionMacros\TestCase;

/**
 * @internal
 * @coversNothing
 */
class InsertAtTest extends TestCase
{
    /** @test */
    public function itProvidesAnInsertAtMacro()
    {
        $this->assertTrue(Collection::hasMacro('insertAt'));
    }

    /** @test */
    public function itInsertsAtTheCorrectIndex()
    {
        $collection = Collection::make(['zero', 'two', 'three']);
        $collection->insertAt(1, 'one');
        $this->assertEquals(json_encode(['zero', 'one', 'two', 'three']), json_encode($collection->toArray()));
    }

    /** @test */
    public function itReturnsTheUpdatedCollection()
    {
        $collection = Collection::make(['zero', 'two', 'three'])->insertAt(1, 'one');
        $this->assertEquals(json_encode(['zero', 'one', 'two', 'three']), json_encode($collection->toArray()));
    }

    /** @test */
    public function itMaintainsArrayKeys()
    {
        $collection = Collection::make(['zero' => 0, 'two' => 2, 'three' => 3])->insertAt(1, 'one');
        $this->assertEquals(
            json_encode(['zero' => 0, 'one', 'two' => 2, 'three' => 3]),
            json_encode($collection->toArray())
        );
    }

    /** @test */
    public function itInsertsWithAKey()
    {
        $collection = Collection::make(['zero' => 0, 'two' => 2, 'three' => 3])->insertAt(1, 5, 'five');

        $this->assertEquals(
            json_encode(['zero' => 0, 'five' => 5, 'two' => 2, 'three' => 3]),
            json_encode($collection->toArray())
        );
    }
}
