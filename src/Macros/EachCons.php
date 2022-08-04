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
 * Get the consecutive values in the collection defined by the given chunk size.
 *
 * @mixin \Hyperf\Utils\Collection
 */
class EachCons
{
    public function __invoke()
    {
        return function (int $chunkSize, bool $preserveKeys = false): Collection {
            $size = $this->count() - $chunkSize + 1;
            $result = collect(range(0, $size))->reduce(function ($result, $index) use ($chunkSize, $preserveKeys) {
                $next = $this->slice($index, $chunkSize);

                return $next->count() === $chunkSize ? $result->push($preserveKeys ? $next : $next->values()) : $result;
            }, new static([]));

            return $preserveKeys ? $result : $result->values();
        };
    }
}
