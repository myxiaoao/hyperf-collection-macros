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
class FilterMapTest extends TestCase
{
    /** @test */
    public function itReturnsAMappedCollectionWithoutEmptyValues()
    {
        $result = Collection::make([1, 2, 3, 4, 5, 6])->filterMap(function ($number) {
            $quotient = $number / 3;

            return is_int($quotient) ? $quotient : null;
        });

        $this->assertEquals([1, 2], $result->values()->toArray());
    }
}
