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

use Hyperf\Utils\Arr;

/*
 * Get an item from the collection with multidimensional data using "dot" notation.
 *
 * @param mixed $key
 * @param mixed $default
 *
 * @mixin \Hyperf\Utils\Collection
 *
 * @return mixed
 */
class Path
{
    public function __invoke()
    {
        return function ($key, $default = null) {
            return Arr::get($this->items, $key, $default);
        };
    }
}
