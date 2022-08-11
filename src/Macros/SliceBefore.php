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

use Hyperf\Utils\Collection;

/**
 * Slice a collection before a given callback is met into separate chunks.
 *
 * @param callable $callback
 * @param bool $preserveKeys
 *
 * @mixin \Hyperf\Utils\Collection
 *
 * @return \Hyperf\Utils\Collection
 */
class SliceBefore
{
    public function __invoke()
    {
        return function ($callback, bool $preserveKeys = false): Collection {
            if ($this->isEmpty()) {
                return new static();
            }

            if (! $preserveKeys) {
                $sliced = new static([
                    new static([$this->first()]),
                ]);

                return $this->eachCons(2)->reduce(function ($sliced, $previousAndCurrent) use ($callback) {
                    [$previousItem, $item] = $previousAndCurrent;

                    $callback($item, $previousItem)
                        ? $sliced->push(new static([$item]))
                        : $sliced->last()->push($item);

                    return $sliced;
                }, $sliced);
            }

            $sliced = new static([$this->take(1)]);

            return $this->eachCons(2, $preserveKeys)->reduce(function ($sliced, $previousAndCurrent) use ($callback) {
                $previousItem = $previousAndCurrent->take(1);
                $item = $previousAndCurrent->take(-1);

                $itemKey = $item->keys()->first();
                $valuesItem = $item->first();
                $valuesPreviousItem = $previousItem->first();

                $callback($valuesItem, $valuesPreviousItem)
                    ? $sliced->push($item)
                    : $sliced->last()->put($itemKey, $valuesItem);

                return $sliced;
            }, $sliced);
        };
    }
}
