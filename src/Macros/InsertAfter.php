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
 * Inserts an item after another item.
 *
 * @param mixed $after
 * @param mixed $item
 * @param mixed $key
 *
 * @mixin \Hyperf\Utils\Collection
 *
 * @return Collection
 */
class InsertAfter
{
    public function __invoke()
    {
        return function ($after, $item, $key = null): Collection {
            $afterKey = array_search($after, $this->items);

            return $this->insertAfterKey($afterKey, $item, $key);
        };
    }
}
