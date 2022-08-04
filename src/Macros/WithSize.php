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
 * Create a new collection with the specified amount of items.
 *
 * @param int $size
 *
 * @mixin \Hyperf\Utils\Collection
 *
 * @return \Hyperf\Utils\Collection
 */
class WithSize
{
    public function __invoke()
    {
        return function (int $size): Collection {
            if ($size < 1) {
                return new Collection();
            }

            return new Collection(range(1, $size));
        };
    }
}
