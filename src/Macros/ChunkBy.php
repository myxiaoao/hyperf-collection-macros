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

use Closure;
use Hyperf\Utils\Collection;

/**
 * Separate a collection into chunks as long as the given callback returns true.
 *
 * @mixin \Hyperf\Utils\Collection
 */
class ChunkBy
{
    public function __invoke()
    {
        return function (Closure $callback, bool $preserveKeys = false): Collection {
            return $this->sliceBefore(function ($item, $prevItem) use ($callback) {
                return $callback($item) !== $callback($prevItem);
            }, $preserveKeys);
        };
    }
}
