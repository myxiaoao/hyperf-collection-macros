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
 * Get the array of values of a given key.
 *
 * @param array|string $value
 * @param null|string $key
 *
 * @mixin \Hyperf\Utils\Collection
 *
 * @return array
 */
class PluckToArray
{
    public function __invoke()
    {
        return function ($value, $key = null): array {
            return $this->pluck($value, $key)->toArray();
        };
    }
}
