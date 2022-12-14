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
namespace Cooper\HyperfCollectionMacros\Macros;

class WeightedRandom
{
    public function __invoke()
    {
        return function (callable|string $weightAttribute, $default = null) {
            if (is_string($weightAttribute)) {
                $attributeName = $weightAttribute;

                $weightAttribute = function ($item) use ($attributeName) {
                    return data_get($item, $attributeName);
                };
            }

            $range = 0;

            $weightedItems = collect($this->items)
                ->map(function ($item) use ($weightAttribute, &$range) {
                    $weightAttribute = $weightAttribute($item);
                    $range += $weightAttribute;

                    return [
                        'range' => $range,
                        'weight' => $weightAttribute,
                        'item' => $item,
                    ];
                })
                ->filter(function (array $weightedItem) {
                    return $weightedItem['weight'] > 0;
                });

            if ($weightedItems->isEmpty()) {
                return $this->random();
            }

            $randomNumber = rand(1, $range);

            $itemAndRange = $weightedItems
                ->first(function ($weightedItem) use ($randomNumber) {
                    return $weightedItem['range'] >= $randomNumber;
                });

            return $itemAndRange['item'] ?? $default;
        };
    }
}
