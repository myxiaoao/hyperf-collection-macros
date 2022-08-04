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
use Mockery;
use Mockery\MockInterface;

/**
 * @internal
 * @coversNothing
 */
class IfEmptyTest extends TestCase
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
    public function itExecutesTheCallableIfTheCollectionIsEmpty()
    {
        Collection::make()->ifEmpty(function () {
            $this->spy->someCall();
        });

        $this->spy->shouldHaveReceived('someCall')->once();
    }

    /** @test */
    public function itPassTheCollectionInTheCallback()
    {
        $originCollection = Collection::make();

        $originCollection->ifEmpty(function (Collection $collection) use ($originCollection) {
            $this->assertEquals($originCollection, $collection);
        });
    }

    /** @test */
    public function itDoesntExecuteTheCallableIfTheCollectionIsntEmpty()
    {
        Collection::make(['foo'])->ifEmpty(function () {
            $this->spy->someCall();
        });

        $this->spy->shouldNotHaveReceived('someCall');
    }

    /** @test */
    public function itProvidesAFluentInterface()
    {
        $collection = Collection::make();

        $this->assertEquals($collection, $collection->ifEmpty(function () {
        }));
    }
}
