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

/**
 * Execute a callable if the collection is empty, then return the collection.
 *
 * @mixin \Hyperf\Utils\Collection
 */
class IfEmpty
{
    public function __invoke()
    {
        return function (callable $callback): Collection {
            if ($this->isEmpty()) {
                $callback($this);
            }

            return $this;
        };
    }
}
