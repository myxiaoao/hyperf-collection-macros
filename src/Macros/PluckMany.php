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

use ArrayAccess;
use Hyperf\Utils\Arr;
use Hyperf\Utils\Collection;

/**
 * Get a Collection with only the specified keys.
 *
 * @param array $keys
 *
 * @mixin \Hyperf\Utils\Collection
 *
 * @return Collection
 */
class PluckMany
{
    public function __invoke()
    {
        return function ($keys): Collection {
            return $this->map(function ($item) use ($keys) {
                if ($item instanceof Collection) {
                    return $item->only($keys);
                }

                if (is_array($item)) {
                    return Arr::only($item, $keys);
                }

                if ($item instanceof ArrayAccess) {
                    return collect($keys)->mapWithKeys(function ($key) use ($item) {
                        return [$key => $item[$key]];
                    })->toArray();
                }

                return (object) Arr::only(get_object_vars($item), $keys);
            });
        };
    }
}
