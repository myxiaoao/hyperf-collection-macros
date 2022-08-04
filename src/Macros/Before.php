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
 * Get the previous item from the collection.
 *
 * @param mixed $currentItem
 * @param mixed $fallback
 *
 * @mixin \Hyperf\Utils\Collection
 *
 * @return mixed
 */
class Before
{
    public function __invoke()
    {
        return function ($currentItem, $fallback = null) {
            return $this->reverse()->after($currentItem, $fallback);
        };
    }
}
