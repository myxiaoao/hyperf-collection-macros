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
 * Get a single item from the collection by index.
 *
 * @param mixed $index
 *
 * @mixin \Hyperf\Utils\Collection
 *
 * @return mixed
 */
class At
{
    public function __invoke()
    {
        /*
         * Get a single item from the collection by index.
         *
         * @param mixed $index
         *
         * @mixin \Hyperf\Utils\Collection
         *
         * @return mixed
         */
        return function ($index) {
            return $this->slice($index, 1)->first();
        };
    }
}
