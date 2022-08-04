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
 * Skip the first {$count} items.
 *
 * @param int $count
 *
 * @mixin \Hyperf\Utils\Collection
 *
 * @return mixed
 */
class Skip
{
    public function __invoke()
    {
        return function ($count): Collection {
            return $this->slice($count);
        };
    }
}
