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
class BeforeTest extends TestCase
{
    /** @test */
    public function itCanRetrieveAnItemThatComesBeforeAnItem()
    {
        $data = new Collection([1, 2, 3]);

        $this->assertEquals(1, $data->before(2));
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

        $this->assertEquals(2, $data->before(4));
    }

    /** @test */
    public function itCanFindThePreviousItemInACollectionOfStrings()
    {
        $data = new Collection([
            'foo' => 'bar',
            'bar' => 'foo',
        ]);

        $this->assertEquals('bar', $data->before('foo'));
    }

    /** @test */
    public function itCanFindThePreviousItemBasedOnACallback()
    {
        $data = new Collection([3, 1, 2]);

        $result = $data->before(function ($item) {
            return $item < 2;
        });

        $this->assertEquals(3, $result);
    }

    /** @test */
    public function itReturnsNullIfThereIsntAPreviousItem()
    {
        $data = new Collection([1, 2, 3]);

        $this->assertNull($data->before(1));
    }

    /** @test */
    public function itCanReturnAFallbackValueIfThereIsntAPreviousItem()
    {
        $data = new Collection([1, 2, 3]);

        $this->assertEquals('The void', $data->before(1, 'The void'));
    }
}
