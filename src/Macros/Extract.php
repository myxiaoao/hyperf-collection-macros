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
 * Extract keys from a collection, like `only`, except:
 * - If a value doesn't exist, it returns null instead of omitting it
 * - It returns a collection without keys, so `list()` can be used.
 *
 * @mixin \Hyperf\Utils\Collection
 *
 * @return \Hyperf\Utils\Collection
 */
class Extract
{
    public function __invoke()
    {
        return function ($keys): Collection {
            $keys = is_array($keys) ? $keys : func_get_args();

            return array_reduce($keys, function ($extracted, $key) {
                return $extracted->push(
                    data_get($this->items, $key)
                );
            }, new static());
        };
    }
}
