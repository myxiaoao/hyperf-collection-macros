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

namespace HyperfTest\HyperfCollectionMacros\Macros;

use Hyperf\Utils\Collection;
use HyperfTest\HyperfCollectionMacros\TestCase;

/**
 * @internal
 * @coversNothing
 */
class RecursiveTest extends TestCase
{
    /** @test */
    public function itCovertsChildArraysToCollections()
    {
        $collection = Collection::make([
            'child' => [
                1, 2, 3, 'anotherchild' => [1, 2, 3],
            ],
        ])
            ->recursive();

        $this->assertInstanceOf(Collection::class, $collection['child']);
        $this->assertInstanceOf(Collection::class, $collection['child']['anotherchild']);
    }

    /** @test */
    public function itCovertsChildObjectsToCollections()
    {
        $collection = Collection::make([
            'child' => (object) [1, 2, 3, 'anotherchild' => (object) [1, 2, 3]],
        ])
            ->recursive();

        $this->assertInstanceOf(Collection::class, $collection['child']);
        $this->assertInstanceOf(Collection::class, $collection['child']['anotherchild']);
    }
}
