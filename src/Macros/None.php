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
 * Check whether a collection doesn't contain any occurrences of a given
 * item, key-value pair, or passing truth test. `none` accepts the same
 * parameters as the `contains` collection method.
 *
 * @see \Hyperf\Utils\Collection::contains
 *
 * @param mixed $key
 * @param mixed $value
 *
 * @mixin \Hyperf\Utils\Collection
 *
 * @return bool
 */
class None
{
    public function __invoke()
    {
        return function ($key, $value = null): bool {
            if (func_num_args() === 2) {
                return ! $this->contains($key, $value);
            }

            return ! $this->contains($key);
        };
    }
}
