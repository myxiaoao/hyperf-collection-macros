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

use ArrayAccess;
use Hyperf\Utils\Collection;
use Hyperf\Utils\Arr;

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
