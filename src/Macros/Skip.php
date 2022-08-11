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
 * Skip the first {$count} items.
 *
 * @param int $count
 *
 * @mixin \Hyperf\Utils\Collection
 *
 * @return mixed
 */
class Skip
{
    public function __invoke()
    {
        return function ($count): Collection {
            return $this->slice($count);
        };
    }
}
