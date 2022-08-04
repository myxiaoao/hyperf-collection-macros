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
 * Inserts an item before another item by key.
 *
 * @param mixed $beforeKey
 * @param mixed $item
 * @param mixed $key
 *
 * @mixin \Hyperf\Utils\Collection
 *
 * @return Collection
 */
class InsertBeforeKey
{
    public function __invoke()
    {
        return function ($beforeKey, $item, $key = null): Collection {
            $index = array_search($beforeKey, array_keys($this->items));

            return $this->insertAt($index, $item, $key);
        };
    }
}
