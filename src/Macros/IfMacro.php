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

class IfMacro
{
    public function __invoke()
    {
        return function (mixed $if, mixed $then = null, mixed $else = null): mixed {
            return value($if, $this) ? value($then, $this) : value($else, $this);
        };
    }
}
