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
 * Inserts an item after another item by key.
 *
 * @param mixed $afterKey
 * @param mixed $item
 * @param mixed $key
 *
 * @mixin \Hyperf\Utils\Collection
 *
 * @return Collection
 */
class InsertAfterKey
{
    public function __invoke()
    {
        return function ($afterKey, $item, $key = null): Collection {
            $index = array_search($afterKey, array_keys($this->items));

            return $this->insertAt($index + 1, $item, $key);
        };
    }
}
