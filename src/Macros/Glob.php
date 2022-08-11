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
