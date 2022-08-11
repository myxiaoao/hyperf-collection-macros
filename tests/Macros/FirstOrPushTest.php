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

use Hyperf\Utils\Collection;
use HyperfTest\HyperfCollectionMacros\TestCase;

/**
 * @internal
 * @coversNothing
 */
class FirstOrPushTest extends TestCase
{
    /** @test */
    public function itCanRetrieveAValueIfOneExists()
    {
        $data = new Collection([1, 2, 3]);

        $this->assertEquals(1, $data->firstOrPush(fn ($item) => $item === 1, 2));
    }

    /** @test */
    public function ifAValueDoesntExistTheSecondArgumentIsPushedInToTheCollectionAndReturned()
    {
        $data = new Collection([1, 2]);

        $this->assertEquals(3, $data->firstOrPush(fn ($item) => $item === 3, 3));
        $this->assertEquals(3, $data->firstOrPush(fn ($item) => $item === 3, 4));
    }

    /** @test */
    public function theValueParameterCanBeACallable()
    {
        $this->assertEquals(1, (new Collection())->firstOrPush(fn ($item) => false, fn () => 1));
    }

    /** @test */
    public function aCollectionObjectCanBeSpecifiedAsThePushTarget()
    {
        $data = new Collection([1, 2, 3]);
        $data->filter(fn ($item) => false)->firstOrPush(fn ($item) => false, 4, $data);

        $this->assertEquals(new Collection([1, 2, 3, 4]), $data);
    }
}
