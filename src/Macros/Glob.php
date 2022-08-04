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

/*
 * Execute a callable if the collection isn't empty, then return the collection.
 */
class Glob
{
    public function __invoke()
    {
        return function (string $pattern, int $flags = 0): Collection {
            return Collection::make(glob($pattern, $flags));
        };
    }
}
