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

use Cooper\HyperfCollectionMacros\Exceptions\CollectionItemNotFound;
use Hyperf\Utils\Collection;
use HyperfTest\HyperfCollectionMacros\TestCase;

/**
 * @internal
 * @coversNothing
 */
class FirstOrFailTest extends TestCase
{
    /** @test */
    public function itReturnsFirstItemWhenThereIsOne()
    {
        if (method_exists(Collection::class, 'firstOrFail')) {
            $this->expectNotToPerformAssertions();

            return;
        }

        $result = Collection::make([1, 2, 3, 4])->firstOrFail();

        $this->assertEquals(1, $result);
    }

    /** @test */
    public function itThrowsExceptionWhenThereAreNoItems()
    {
        if (method_exists(Collection::class, 'firstOrFail')) {
            $this->expectNotToPerformAssertions();

            return;
        }

        $this->expectException(CollectionItemNotFound::class);

        Collection::make()->firstOrFail();
    }
}
