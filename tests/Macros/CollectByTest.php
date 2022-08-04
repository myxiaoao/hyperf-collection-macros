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
class CollectByTest extends TestCase
{
    /** @test */
    public function itReturnsACollectionContainingTheCollectedItems()
    {
        $collection = new Collection([
            'name' => 'taco',
            'ingredients' => [
                'cheese',
                'lettuce',
                'beef',
                'tortilla',
            ],
            'should_eat' => true,
        ]);

        $ingredients = $collection->collectBy('ingredients');

        $this->assertInstanceOf(Collection::class, $ingredients);

        $this->assertEquals([
            'cheese',
            'lettuce',
            'beef',
            'tortilla',
        ], $ingredients->toArray());
    }

    /** @test */
    public function itReturnsDefaultWhenKeyIsMissing()
    {
        $collection = new Collection([
            'name' => 'taco',
            'ingredients' => [
                'cheese',
                'lettuce',
                'beef',
                'tortilla',
            ],
            'should_eat' => true,
        ]);

        $ingredients = $collection->collectBy('build_it', $collection->get('ingredients'));

        $this->assertEquals($collection->collectBy('ingredients'), $ingredients);
    }

    /** @test */
    public function itReturnsEmptyCollectionWhenMissingKeyWithoutDefault()
    {
        $collection = new Collection([
            'name' => 'taco',
            'ingredients' => [
                'cheese',
                'lettuce',
                'beef',
                'tortilla',
            ],
            'should_eat' => true,
        ]);

        $ingredients = $collection->collectBy('build_it');

        $this->assertEquals(new Collection(), $ingredients);
    }
}
