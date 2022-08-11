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
