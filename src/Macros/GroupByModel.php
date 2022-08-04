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
namespace Cooper\HyperfCollectionMacros\Macros;

use Hyperf\Utils\Collection;

/**
 * Group a collection by an Eloquent model.
 *
 * @param callable|string $callback
 * @param bool $preserveKeys
 * @param mixed $modelKey
 * @param mixed $itemsKey
 *
 * @mixin \Hyperf\Utils\Collection
 *
 * @return \Hyperf\Utils\Collection
 */
class GroupByModel
{
    public function __invoke()
    {
        return function ($callback, bool $preserveKeys = false, $modelKey = 0, $itemsKey = 1): Collection {
            $callback = $this->valueRetriever($callback);

            return $this->groupBy(function ($item) use ($callback) {
                return $callback($item)->getKey();
            }, $preserveKeys)->map(function (Collection $items) use ($callback, $modelKey, $itemsKey) {
                return [
                    $modelKey => $callback($items->first()),
                    $itemsKey => $items,
                ];
            })->values();
        };
    }
}
