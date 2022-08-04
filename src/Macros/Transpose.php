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
 * Transpose an array.
 *
 * @mixin \Hyperf\Utils\Collection
 *
 * @throws \LengthException
 * @return \Hyperf\Utils\Collection
 */
class Transpose
{
    public function __invoke()
    {
        return function (): Collection {
            if ($this->isEmpty()) {
                return new static();
            }

            $firstItem = $this->first();

            $expectedLength = is_countable($firstItem) ? count($firstItem) : 0;

            array_walk($this->items, function ($row) use ($expectedLength) {
                if (is_countable($row) && count($row) !== $expectedLength) {
                    throw new \LengthException("Element's length must be equal.");
                }
            });

            $items = array_map(function (...$items) {
                return new static($items);
            }, ...array_map(function ($items) {
                return $this->getArrayableItems($items);
            }, array_values($this->items)));

            return new static($items);
        };
    }
}
