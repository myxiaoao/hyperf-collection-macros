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
class AtTest extends TestCase
{
    /** @test */
    public function itRetrievesAnItemByPositiveIndex()
    {
        $data = new Collection([1, 2, 3]);

        $this->assertEquals(2, $data->at(1));
    }

    /** @test */
    public function itRetrievesAnItemByNegativeIndex()
    {
        $data = new Collection([1, 2, 3]);

        $this->assertEquals(3, $data->at(-1));
    }

    /** @test */
    public function itRetrievesAnItemByZeroIndex()
    {
        $data = new Collection([1, 2, 3]);

        $this->assertEquals(1, $data->at(0));
    }
}
