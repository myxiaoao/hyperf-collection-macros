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
class PluckToArrayTest extends TestCase
{
    /** @test */
    public function itReturnsArrayOfAttributes()
    {
        $result = Collection::make([
            ['id' => 1],
            ['id' => 2],
            ['id' => 3],
        ])->pluckToArray('id');

        $expected = [1, 2, 3];

        $this->assertEquals($expected, $result);

        $this->assertIsArray($result);
    }

    /** @test */
    public function itReturnArrayOfAttributesWithCorrectKeys()
    {
        $result = Collection::make([
            ['id' => 2, 'title' => 'A'],
            ['id' => 3, 'title' => 'B'],
            ['id' => 4, 'title' => 'C'],
        ])->pluckToArray('title', 'id');

        $expected = [2 => 'A', 3 => 'B', 4 => 'C'];

        $this->assertEquals($expected, $result);
    }
}
