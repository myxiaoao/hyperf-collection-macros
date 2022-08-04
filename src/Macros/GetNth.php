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
