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

/**
 * Sort items in descending order.
 *
 * @param int $options
 *
 * @mixin \Hyperf\Utils\Collection
 *
 * @return mixed
 */
class SortDesc
{
    public function __invoke()
    {
        return function ($options = SORT_REGULAR) {
            $items = $this->items;

            arsort($items, $options);

            return new static($items);
        };
    }
}
