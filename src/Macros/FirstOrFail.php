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

use Cooper\HyperfCollectionMacros\Exceptions\CollectionItemNotFound;

/**
 * Get the first item. Throws CollectionItemNotFound if the item was not found.
 *
 * @mixin \Hyperf\Utils\Collection
 *
 * @return mixed
 */
class FirstOrFail
{
    public function __invoke()
    {
        return function () {
            if (! is_null($item = $this->first())) {
                return $item;
            }

            throw new CollectionItemNotFound('No items found in collection.');
        };
    }
}
