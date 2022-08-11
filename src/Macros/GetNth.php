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

/*
 * Get the previous item from the collection.
 *
 * @param int $nth
 * @param mixed $fallback
 *
 * @mixin \Hyperf\Utils\Collection
 *
 * @return mixed
 */
class GetNth
{
    public function __invoke()
    {
        return function (int $nth) {
            return $this->slice($nth - 1, 1)->first();
        };
    }
}
