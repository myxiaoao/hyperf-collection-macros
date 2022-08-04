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
class PathTest extends TestCase
{
    /** @test */
    public function itRetrievesItemFromCollection()
    {
        $collection = new Collection(['foo', 'bar']);

        $this->assertSame(
            'foo',
            $collection->path(0)
        );
    }

    /** @test */
    public function itRetrievesItemFromCollectionUsingDotNotation()
    {
        $collection = new Collection([
            'foo' => [
                'bar' => [
                    'baz' => 100,
                ],
            ],
        ]);

        $this->assertSame(
            100,
            $collection->path('foo.bar.baz')
        );
    }

    /** @test */
    public function itDoesntRemoveItemFromCollection()
    {
        $collection = new Collection(['foo', 'bar']);

        $collection->path(0);

        $this->assertEquals(
            [
                0 => 'foo',
                1 => 'bar',
            ],
            $collection->all()
        );
    }

    /** @test */
    public function itReturnsDefault()
    {
        $collection = new Collection([]);

        $this->assertSame(
            'foo',
            $collection->path(0, 'foo')
        );
    }
}
