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
 * Move elements to the start of the collection.
 *
 * @param callable $callable
 *
 * @mixin \Hyperf\Utils\Collection
 *
 * @return \Hyperf\Utils\Collection
 */
class Prioritize
{
    public function __invoke()
    {
        return function (callable $callable): Collection {
            $nonPrioritized = $this->reject($callable);

            return $this
                ->filter($callable)
                ->union($nonPrioritized);
        };
    }
}
