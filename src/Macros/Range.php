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

/**
 * Create a collection with the given range.
 *
 * @param int $from
 * @param int $to
 *
 * @mixin \Hyperf\Utils\Collection
 *
 * @return mixed
 */
class Range
{
    public function __invoke()
    {
        return function ($from, $to) {
            return new static(range($from, $to));
        };
    }
}
