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
 * Get a new collection from the collection by key.
 *
 * @param mixed $key
 * @param mixed $default
 *
 * @mixin \Hyperf\Utils\Collection
 *
 * @return static
 */
class CollectBy
{
    public function __invoke()
    {
        return function ($key, $default = null): Collection {
            return new static($this->get($key, $default));
        };
    }
}
