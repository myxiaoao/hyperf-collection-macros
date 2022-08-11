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
