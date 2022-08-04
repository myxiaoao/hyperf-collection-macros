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

use Illuminate\Support\Enumerable;

/**
 * Retrieve the first item that passes the given callback, or push
 * the resolved callable into the collection and return it if
 * no matching value is found. You may specify the collection
 * instance to push into as a third parameter.
 *
 * @param callable $callable
 * @param callable|mixed $value
 * @param null|Enumerable $instance
 *
 * @mixin \Hyperf\Utils\Collection
 *
 * @return mixed
 */
class FirstOrPush
{
    public function __invoke()
    {
        return function ($callback, $value, $instance = null) {
            return $this->first($callback) ?? tap(
                value($value),
                fn ($resolved) => ($instance ?? $this)->push($resolved)
            );
        };
    }
}
