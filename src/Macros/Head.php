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
 * Get the first item from the collection.
 *
 * @mixin \Hyperf\Utils\Collection
 *
 * @return mixed
 */
class Head
{
    public function __invoke()
    {
        return function () {
            return $this->first();
        };
    }
}
