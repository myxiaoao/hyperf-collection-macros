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
class WeightedRandomTest extends TestCase
{
    /** @test */
    public function itWillProbablyReturnTheHeaviestItemMost()
    {
        $items = collect([
            ['value' => 'a', 'weight' => 1],
            ['value' => 'b', 'weight' => 10],
            ['value' => 'c', 'weight' => 1],
        ]);

        $mostPopularValue = Collection::range(0, 1000)
            ->map(function () use ($items) {
                return $items->weightedRandom(function (array $item) {
                    return $item['weight'];
                });
            })
            ->groupBy('value')
            ->map
            ->count()
            ->sortDesc()
            ->flip()
            ->first();

        $this->assertEquals('b', $mostPopularValue);
    }

    /** @test */
    public function itWillNotPickAValueWithoutAWeight()
    {
        $items = collect([
            ['value' => 'a', 'weight' => 0],
            ['value' => 'b', 'weight' => 0],
            ['value' => 'c', 'weight' => 1],
            ['value' => 'c', 'weight' => 0],
        ]);

        $pickedItem = $items->weightedRandom(fn (array $item) => $item['weight']);

        $this->assertEquals('c', $pickedItem['value']);
    }

    /** @test */
    public function itWillPickARandomValueWhenAllValuesAreZero()
    {
        $items = collect([
            ['value' => 'a', 'weight' => 0],
            ['value' => 'b', 'weight' => 0],
            ['value' => 'c', 'weight' => 0],
        ]);

        $this->assertIsArray($items->weightedRandom(fn (array $item) => $item['weight']));
    }

    /** @test */
    public function itCanPickAWeightedRandomByAttributeName()
    {
        $items = collect([
            ['value' => 'a', 'weight' => 0],
            ['value' => 'b', 'weight' => 1],
            ['value' => 'c', 'weight' => 0],
        ]);

        $item = $items->weightedRandom('weight');

        $this->assertEquals('b', $item['value']);
    }
}
