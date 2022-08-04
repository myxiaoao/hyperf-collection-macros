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
class RotateTest extends TestCase
{
    /** @test */
    public function itProvidesRotateMacro()
    {
        $this->assertTrue(Collection::hasMacro('rotate'));
    }

    /** @test */
    public function itCanReturnEmptyCollectionIfGivenEmptyCollecton()
    {
        $collection = new Collection([]);
        $this->assertCount(0, $collection->rotate(2)->toArray());
    }

    /** @test */
    public function itCanReturnSameCollectionIfGivenZeroOffset()
    {
        $collection = new Collection([1, 2, 3, 4, 5, 6]);
        $this->assertEquals([1, 2, 3, 4, 5, 6], $collection->rotate(0)->toArray());
    }

    /** @test */
    public function itCanRotateTheCollectionWithOffset()
    {
        $collection = new Collection([1, 2, 3, 4, 5, 6]);
        $this->assertEquals([3, 4, 5, 6, 1, 2], $collection->rotate(2)->toArray());
    }

    /** @test */
    public function itCanRotateTheCollectionWithNegativeOffset()
    {
        $collection = new Collection([1, 2, 3, 4, 5, 6]);
        $this->assertEquals([5, 6, 1, 2, 3, 4], $collection->rotate(-2)->toArray());
    }

    /** @test */
    public function itCanRotateTheCollectionWithOffsetWithKeys()
    {
        $collection = new Collection(['first' => 1, 'second' => 2, 'third' => 3, 'fourth' => 4, 'fifth' => 5]);
        $this->assertEquals(['fourth' => 4, 'fifth' => 5, 'first' => 1, 'second' => 2, 'third' => 3], $collection->rotate(3)->toArray());
    }

    /** @test */
    public function itCanRotateTheCollectionWithNagativeOffsetWithKeys()
    {
        $collection = new Collection(['first' => 1, 'second' => 2, 'third' => 3, 'fourth' => 4, 'fifth' => 5]);
        $this->assertEquals(['third' => 3, 'fourth' => 4, 'fifth' => 5, 'first' => 1, 'second' => 2], $collection->rotate(-3)->toArray());
    }
}
