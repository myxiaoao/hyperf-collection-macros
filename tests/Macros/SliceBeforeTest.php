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
class SliceBeforeTest extends TestCase
{
    /** @test */
    public function itProvidesSliceBeforeMacro()
    {
        $this->assertTrue(Collection::hasMacro('sliceBefore'));
    }

    /** @test */
    public function itCanSliceBeforeTheCollectionWithAGivenCallback()
    {
        $collection = new Collection([10, 34, 51, 17, 47, 64, 9, 44, 20, 59, 66, 77]);

        $sliced = $collection->sliceBefore(function ($number) {
            return $number > 50;
        });

        $expected = [
            [10, 34],
            [51, 17, 47],
            [64, 9, 44, 20],
            [59],
            [66],
            [77],
        ];

        $this->assertEquals($expected, $sliced->toArray());
    }

    /** @test */
    public function itCanSliceBeforeTheCollectionWithAGivenCallbackWithPreservingTheOriginalKeys()
    {
        $collection = new Collection([10, 34, 51, 17, 47, 64, 9, 44, 20, 59, 66, 77]);

        $sliced = $collection->sliceBefore(function ($number) {
            return $number > 50;
        }, true);

        $expected = [
            [0 => 10, 1 => 34],
            [2 => 51, 3 => 17, 4 => 47],
            [5 => 64, 6 => 9, 7 => 44, 8 => 20],
            [9 => 59],
            [10 => 66],
            [11 => 77],
        ];

        $toArray = $sliced->toArray();
        $this->assertEquals($expected, $toArray);
    }

    /** @test */
    public function itCanSliceBeforeTheCollectionWithComplexDataWithAGivenCallbackWithoutPreservingTheOriginalKeys()
    {
        $collection = new Collection([10, [34, 51], [17], 47, [64, 9], 44, [20], [59], [66], 77]);

        $sliced = $collection->sliceBefore(function ($item) {
            return is_array($item);
        });

        $expected = [
            [10],
            [[34, 51]],
            [[17], 47],
            [[64, 9], 44],
            [[20]],
            [[59]],
            [[66], 77],
        ];

        $this->assertEquals($expected, $sliced->toArray());
    }

    /** @test */
    public function itCanSliceBeforeTheCollectionWithComplexDataWithAGivenCallbackWithPreservingTheOriginalKeys()
    {
        $collection = new Collection([10, [34, 51], [17], 47, [64, 9], 44, [20], [59], [66], 77]);

        $sliced = $collection->sliceBefore(function ($item) {
            return is_array($item);
        }, true);

        $expected = [
            [0 => 10],
            [1 => [34, 51]],
            [2 => [17], 3 => 47],
            [4 => [64, 9], 5 => 44],
            [6 => [20]],
            [7 => [59]],
            [8 => [66], 9 => 77],
        ];

        $this->assertEquals($expected, $sliced->toArray());
    }

    /** @test */
    public function itCanSliceBeforeTheCollectionWithAGivenCallbackWithoutPreservingTheOriginalAssociativeKeys()
    {
        $collection = new Collection(['a' => 10, 'b' => 34, 'c' => 51, 'd' => 17, 'e' => 47, 'f' => 64, 'g' => 9, 'h' => 44, 'i' => 20, 'j' => 59, 'k' => 66, 'l' => 77]);

        $sliced = $collection->sliceBefore(function ($number) {
            return $number > 50;
        });

        $expected = [
            [10, 34],
            [51, 17, 47],
            [64, 9, 44, 20],
            [59],
            [66],
            [77],
        ];

        $this->assertEquals($expected, $sliced->toArray());
    }

    /** @test */
    public function itCanSliceBeforeTheCollectionWithAGivenCallbackWithPreservingTheOriginalAssociativeKeys()
    {
        $collection = new Collection(['a' => 10, 'b' => 34, 'c' => 51, 'd' => 17, 'e' => 47, 'f' => 64, 'g' => 9, 'h' => 44, 'i' => 20, 'j' => 59, 'k' => 66, 'l' => 77]);

        $sliced = $collection->sliceBefore(function ($number) {
            return $number > 50;
        }, true);

        $expected = [
            ['a' => 10, 'b' => 34],
            ['c' => 51, 'd' => 17, 'e' => 47],
            ['f' => 64, 'g' => 9, 'h' => 44, 'i' => 20],
            ['j' => 59],
            ['k' => 66],
            ['l' => 77],
        ];

        $this->assertEquals($expected, $sliced->toArray());
    }
}
