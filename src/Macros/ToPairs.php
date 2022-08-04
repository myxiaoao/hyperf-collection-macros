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
 * Transform a collection into an an array with pairs.
 *
 * @mixin \Hyperf\Utils\Collection
 *
 * @return \Hyperf\Utils\Collection
 */
class ToPairs
{
    public function __invoke()
    {
        return function (): Collection {
            return $this->keys()->map(function ($key) {
                return [$key, $this->items[$key]];
            });
        };
    }
}
