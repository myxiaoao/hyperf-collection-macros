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
class AfterTest extends TestCase
{
    /** @test */
    public function itCanRetrieveAnItemThatComesAfterAnItem()
    {
        $data = new Collection([1, 2, 3]);

        $this->assertEquals(2, $data->after(1));
    }

    /** @test */
    public function itRetrievesItemsByValueAndDoesntReorderThem()
    {
        $data = new Collection([
            4 => 3,
            2 => 1,
            1 => 2,
            3 => 4,
        ]);

        $this->assertEquals(1, $data->after(3));
    }

    /** @test */
    public function itCanFindTheNextItemInACollectionOfStrings()
    {
        $data = new Collection([
            'foo' => 'bar',
            'bar' => 'foo',
        ]);

        $this->assertEquals('foo', $data->after('bar'));
    }

    /** @test */
    public function itCanFindTheNextItemBasedOnACallback()
    {
        $data = new Collection([3, 1, 2]);

        $result = $data->after(function ($item) {
            return $item > 2;
        });

        $this->assertEquals(1, $result);
    }

    /** @test */
    public function itReturnsNullIfThereIsntANextItem()
    {
        $data = new Collection([1, 2, 3]);

        $this->assertNull($data->after(3));
    }

    /** @test */
    public function itCanReturnAFallbackValueIfThereIsntANextItem()
    {
        $data = new Collection([1, 2, 3]);

        $this->assertEquals(4, $data->after(3, 4));
    }
}
