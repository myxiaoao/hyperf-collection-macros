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
 * Execute a callable if the collection isn't empty, then return the collection.
 *
 * @param callable callback
 *
 * @mixin \Hyperf\Utils\Collection
 *
 * @return \Hyperf\Utils\Collection
 */
class IfAny
{
    public function __invoke()
    {
        return function (callable $callback): Collection {
            if (! $this->isEmpty()) {
                $callback($this);
            }

            return $this;
        };
    }
}
