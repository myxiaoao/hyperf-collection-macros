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
 * Returns true if the collection contains one of the given $otherValues.
 *
 * @param array|Collection $otherValues
 *
 * @mixin \Hyperf\Utils\Collection
 *
 * @return bool
 */
class ContainsAll
{
    public function __invoke()
    {
        return function ($values = []): bool {
            $values = (new Collection($values))->unique();

            return $this->intersect($values)->count() == $values->count();
        };
    }
}
