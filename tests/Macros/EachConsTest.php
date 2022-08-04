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
class EachConsTest extends TestCase
{
    /** @test */
    public function itProvidesEachConsMacro()
    {
        $this->assertTrue(Collection::hasMacro('eachCons'));
    }

    /** @test */
    public function itCanChunkTheCollectionIntoConsecutivePairsOfValuesByAGivenChunkSizeOfTwo()
    {
        $collection = new Collection([1, 2, 3, 4, 5, 6, 7, 8]);

        $sliced = $collection->eachCons(2);

        $expected = [
            [1, 2],
            [2, 3],
            [3, 4],
            [4, 5],
            [5, 6],
            [6, 7],
            [7, 8],
        ];

        $this->assertEquals($expected, $sliced->toArray());
    }

    /** @test */
    public function itCanChunkTheCollectionIntoConsecutivePairsOfValuesByAGivenChunkSizeOrGreater()
    {
        $collection = new Collection([1, 2, 3, 4, 5, 6, 7, 8]);

        $sliced = $collection->eachCons(4);

        $expected = [
            [1, 2, 3, 4],
            [2, 3, 4, 5],
            [3, 4, 5, 6],
            [4, 5, 6, 7],
            [5, 6, 7, 8],
        ];

        $this->assertEquals($expected, $sliced->toArray());
    }

    /** @test */
    public function itCanChunkTheCollectionIntoConsecutivePairsOfValuesByAGivenChunkSizeOfTwoWithPreservingTheOriginalKeys()
    {
        $collection = new Collection([1, 2, 3, 4, 5, 6, 7, 8]);

        $sliced = $collection->eachCons(2, true);

        $expected = [
            [0 => 1, 1 => 2],
            [1 => 2, 2 => 3],
            [2 => 3, 3 => 4],
            [3 => 4, 4 => 5],
            [4 => 5, 5 => 6],
            [5 => 6, 6 => 7],
            [6 => 7, 7 => 8],
        ];

        $this->assertEquals($expected, $sliced->toArray());
    }
}
