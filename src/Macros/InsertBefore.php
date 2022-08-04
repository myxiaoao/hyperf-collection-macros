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
 * Inserts an item before another item.
 *
 * @param mixed $before
 * @param mixed $item
 * @param mixed $key
 *
 * @mixin \Hyperf\Utils\Collection
 *
 * @return Collection
 */
class InsertBefore
{
    public function __invoke()
    {
        return function ($before, $item, $key = null): Collection {
            $beforeKey = array_search($before, $this->items);

            return $this->insertBeforeKey($beforeKey, $item, $key);
        };
    }
}
