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
class TailTest extends TestCase
{
    /** @test */
    public function itProvidesTailMacro()
    {
        $this->assertTrue(Collection::hasMacro('tail'));
    }

    /** @test */
    public function itCanTailTheCollectionWithNumbersWithoutPreservingTheKeys()
    {
        $collection = new Collection([10, 34, 51, 17, 47, 64, 9, 44, 20, 59, 66, 77]);

        $tail = $collection->tail();

        $expected = [
            34,
            51,
            17,
            47,
            64,
            9,
            44,
            20,
            59,
            66,
            77,
        ];

        $this->assertEquals($expected, $tail->toArray());
    }

    /** @test */
    public function itCanTailTheCollectionWithStringsWithoutPreservingTheKeys()
    {
        $collection = new Collection(['1', '2', '3', 'Hello', 'Spatie']);

        $tail = $collection->tail();

        $expected = [
            '2',
            '3',
            'Hello',
            'Spatie',
        ];

        $this->assertEquals($expected, $tail->toArray());
    }

    /** @test */
    public function itCanTailTheCollectionWithNumbersWithPreservingTheKeys()
    {
        $collection = new Collection([10, 34, 51, 17, 47, 64, 9, 44, 20, 59, 66, 77]);

        $tail = $collection->tail(true);

        $expected = [
            1 => 34,
            2 => 51,
            3 => 17,
            4 => 47,
            5 => 64,
            6 => 9,
            7 => 44,
            8 => 20,
            9 => 59,
            10 => 66,
            11 => 77,
        ];

        $this->assertEquals($expected, $tail->toArray());
    }

    /** @test */
    public function itCanTailTheCollectionWithStrings()
    {
        $collection = new Collection(['1', '2', '3', 'Hello', 'Spatie']);

        $tail = $collection->tail(true);

        $expected = [
            1 => '2',
            2 => '3',
            3 => 'Hello',
            4 => 'Spatie',
        ];

        $this->assertEquals($expected, $tail->toArray());
    }
}
