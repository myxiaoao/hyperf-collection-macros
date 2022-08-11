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
use Mockery;
use Mockery\MockInterface;

/**
 * @internal
 * @coversNothing
 */
class IfAnyTest extends TestCase
{
    /** @var MockInterface spy */
    private $spy;

    protected function setUp(): void
    {
        parent::setUp();

        $this->spy = Mockery::spy();
    }

    protected function tearDown(): void
    {
        if ($container = Mockery::getContainer()) {
            $this->addToAssertionCount($container->mockery_getExpectationCount());
        }

        Mockery::close();
    }

    /** @test */
    public function itExecutesTheCallableIfTheCollectionIsntEmpty()
    {
        Collection::make(['foo'])->ifAny(function () {
            $this->spy->someCall();
        });

        $this->spy->shouldHaveReceived('someCall')->once();
    }

    /** @test */
    public function itPassTheCollectionInTheCallback()
    {
        $originCollection = Collection::make(['foo']);

        $originCollection->ifAny(function (Collection $collection) use ($originCollection) {
            $this->assertEquals($originCollection, $collection);
        });
    }

    /** @test */
    public function itDoesntExecuteTheCallableIfTheCollectionIsEmpty()
    {
        Collection::make()->ifAny(function () {
            $this->spy->someCall();
        });

        $this->spy->shouldNotHaveReceived('someCall');
    }

    /** @test */
    public function itProvidesAFluentInterface()
    {
        $collection = Collection::make();

        $this->assertEquals($collection, $collection->ifAny(function () {
        }));
    }
}
