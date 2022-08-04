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
class WithSizeTest extends TestCase
{
    /** @test */
    public function itCanCreateACollectionWithTheSpecifiedSize()
    {
        $this->assertEquals([1], Collection::withSize(1)->toArray());
        $this->assertEquals([1, 2, 3], Collection::withSize(3)->toArray());
    }

    /** @test */
    public function itCanCreatesAnEmptyCollectionIfTheGivenSizeIsLowerThanOne()
    {
        $this->assertCount(0, Collection::withSize(0));
        $this->assertCount(0, Collection::withSize(-1));
    }
}
