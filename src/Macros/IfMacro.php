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

class IfMacro
{
    public function __invoke()
    {
        return function (mixed $if, mixed $then = null, mixed $else = null): mixed {
            return value($if, $this) ? value($then, $this) : value($else, $this);
        };
    }
}
