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
class ChunkByTest extends TestCase
{
    /** @test */
    public function itProvidesChunkByMacro()
    {
        $this->assertTrue(Collection::hasMacro('chunkBy'));
    }

    /** @test */
    public function itCanChunkTheCollectionWithAGivenCallback()
    {
        $collection = new Collection(['A', 'A', 'A', 'B', 'B', 'A', 'A', 'C', 'B', 'B', 'A']);

        $chunkedBy = $collection->chunkBy(function ($item) {
            return $item == 'A';
        });

        $expected = [
            ['A', 'A', 'A'],
            ['B', 'B'],
            ['A', 'A'],
            ['C', 'B', 'B'],
            ['A'],
        ];

        $this->assertEquals($expected, $chunkedBy->toArray());
    }

    /** @test */
    public function itCanChunkTheCollectionWithAGivenCallbackWithAssociativeKeys()
    {
        $collection = new Collection(['a' => 'A', 'b' => 'A', 'c' => 'A', 'd' => 'B', 'e' => 'B', 'f' => 'A', 'g' => 'A', 'h' => 'C', 'i' => 'B', 'j' => 'B', 'k' => 'A']);

        $chunkedBy = $collection->chunkBy(function ($item) {
            return $item == 'A';
        });

        $expected = [
            ['A', 'A', 'A'],
            ['B', 'B'],
            ['A', 'A'],
            ['C', 'B', 'B'],
            ['A'],
        ];

        $this->assertEquals($expected, $chunkedBy->toArray());
    }

    /** @test */
    public function itCanChunkTheCollectionWithAGivenCallbackAndPreserveTheOriginalKeys()
    {
        $collection = new Collection(['A', 'A', 'A', 'B', 'B', 'A', 'A', 'C', 'B', 'B', 'A']);

        $chunkedBy = $collection->chunkBy(function ($item) {
            return $item == 'A';
        }, true);

        $expected = [
            [0 => 'A', 1 => 'A', 2 => 'A'],
            [3 => 'B', 4 => 'B'],
            [5 => 'A', 6 => 'A'],
            [7 => 'C', 8 => 'B', 9 => 'B'],
            [10 => 'A'],
        ];

        $this->assertEquals($expected, $chunkedBy->toArray());
    }

    /** @test */
    public function itCanChunkTheCollectionWithAGivenCallbackWithAssociativeKeysAndPreserveTheOriginalKeys()
    {
        $collection = new Collection(['a' => 'A', 'b' => 'A', 'c' => 'A', 'd' => 'B', 'e' => 'B', 'f' => 'A', 'g' => 'A', 'h' => 'C', 'i' => 'B', 'j' => 'B', 'k' => 'A']);

        $chunkedBy = $collection->chunkBy(function ($item) {
            return $item == 'A';
        }, true);

        $expected = [
            ['a' => 'A', 'b' => 'A', 'c' => 'A'],
            ['d' => 'B', 'e' => 'B'],
            ['f' => 'A', 'g' => 'A'],
            ['h' => 'C', 'i' => 'B', 'j' => 'B'],
            ['k' => 'A'],
        ];

        $this->assertEquals($expected, $chunkedBy->toArray());
    }
}
