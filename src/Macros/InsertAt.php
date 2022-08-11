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
