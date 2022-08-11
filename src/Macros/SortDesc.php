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
