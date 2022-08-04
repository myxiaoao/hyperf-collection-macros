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
