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
