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
 * Get the tail of a collection, everything except the first item.
 *
 * @param bool $preserveKeys
 *
 * @mixin \Hyperf\Utils\Collection
 *
 * @return \Hyperf\Utils\Collection
 */
class Tail
{
    public function __invoke()
    {
        return function (bool $preserveKeys = false): Collection {
            return ! $preserveKeys ? $this->slice(1)->values() : $this->slice(1);
        };
    }
}
