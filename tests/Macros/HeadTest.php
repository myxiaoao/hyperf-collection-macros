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
class HeadTest extends TestCase
{
    /** @test */
    public function itProvidesHeadMacro()
    {
        $this->assertTrue(Collection::hasMacro('head'));
    }

    /** @test */
    public function itGetsTheFirstItemOfTheCollection()
    {
        $data = new Collection([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);

        $this->assertEquals(1, $data->head());
    }

    /** @test */
    public function itReturnsNullIfTheCollectionIsEmpty()
    {
        $data = new Collection();

        $this->assertNull($data->head());
    }
}
