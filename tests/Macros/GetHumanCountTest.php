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
class GetHumanCountTest extends TestCase
{
    /** @test */
    public function itGetsTheFirstItemOfTheCollection()
    {
        $data = new Collection([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);

        $this->assertEquals(1, $data->first());
    }

    /** @test */
    public function itGetsTheSecondItemOfTheCollection()
    {
        $data = new Collection([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);

        $this->assertEquals(2, $data->second());
    }

    /** @test */
    public function itGetsTheThirdItemOfTheCollection()
    {
        $data = new Collection([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);

        $this->assertEquals(3, $data->third());
    }

    /** @test */
    public function itGetsTheFourthItemOfTheCollection()
    {
        $data = new Collection([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);

        $this->assertEquals(4, $data->fourth());
    }

    /** @test */
    public function itGetsTheFifthItemOfTheCollection()
    {
        $data = new Collection([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);

        $this->assertEquals(5, $data->fifth());
    }

    /** @test */
    public function itGetsTheSixthItemOfTheCollection()
    {
        $data = new Collection([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);

        $this->assertEquals(6, $data->sixth());
    }

    /** @test */
    public function itGetsTheSeventhItemOfTheCollection()
    {
        $data = new Collection([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);

        $this->assertEquals(7, $data->seventh());
    }

    /** @test */
    public function itGetsTheEighthItemOfTheCollection()
    {
        $data = new Collection([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);

        $this->assertEquals(8, $data->eighth());
    }

    /** @test */
    public function itGetsTheNinthItemOfTheCollection()
    {
        $data = new Collection([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);

        $this->assertEquals(9, $data->ninth());
    }

    /** @test */
    public function itGetsTheTenthItemOfTheCollection()
    {
        $data = new Collection([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);

        $this->assertEquals(10, $data->tenth());
    }

    /** @test */
    public function itGetsTheNthItemOfTheCollection()
    {
        $data = new Collection([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]);

        $this->assertEquals(11, $data->getNth(11));
    }

    /** @test */
    public function itReturnsNullIfIndexIsUndefined()
    {
        $data = new Collection();

        $this->assertNull($data->first());
        $this->assertNull($data->second());
        $this->assertNull($data->third());
        $this->assertNull($data->fourth());
        $this->assertNull($data->fifth());
        $this->assertNull($data->sixth());
        $this->assertNull($data->seventh());
        $this->assertNull($data->eighth());
        $this->assertNull($data->ninth());
        $this->assertNull($data->tenth());
        $this->assertNull($data->getNth(11));
    }
}
