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
 * Inserts an item at a given index with an optional key.
 *
 * @param int $index
 * @param mixed $item
 * @param mixed $key
 *
 * @mixin \Hyperf\Utils\Collection
 *
 * @return Collection
 */
class InsertAt
{
    public function __invoke()
    {
        return function (int $index, $item, $key = null): Collection {
            $after = $this->splice($index);
            $this->items = isset($key)
                    ? $this->put($key, $item)->merge($after)->toArray()
                    : $this->push($item)->merge($after)->toArray();

            return $this;
        };
    }
}
