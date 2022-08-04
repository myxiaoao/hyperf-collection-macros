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
 * Rotate the items in the collection with given offset.
 *
 * @param int $offset
 *
 * @mixin \Hyperf\Utils\Collection
 *
 * @return \Hyperf\Utils\Collection
 */
class Rotate
{
    public function __invoke()
    {
        return function (int $offset): Collection {
            if ($this->isEmpty()) {
                return new static();
            }

            $count = $this->count();

            $offset %= $count;

            if ($offset < 0) {
                $offset += $count;
            }

            return new static($this->slice($offset)->merge($this->take($offset)));
        };
    }
}
