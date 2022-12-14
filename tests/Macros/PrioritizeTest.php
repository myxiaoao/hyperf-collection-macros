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
class PrioritizeTest extends TestCase
{
    /** @test */
    public function itMovesASingleElementToTheStartOfTheCollection()
    {
        $collection = Collection::make([
            ['id' => 1],
            ['id' => 2],
            ['id' => 3],
        ]);

        $prioritized = $collection->prioritize(function (array $item) {
            return $item['id'] === 2;
        });

        $this->assertEquals([2, 1, 3], $prioritized->pluck('id')->toArray());
    }

    /** @test */
    public function itMovesMultipleElementsToTheStartOfTheCollection()
    {
        $collection = Collection::make([
            ['id' => 1],
            ['id' => 2],
            ['id' => 3],
            ['id' => 4],
        ]);

        $prioritized = $collection->prioritize(function (array $item) {
            return in_array($item['id'], [2, 4]);
        });

        $this->assertEquals([2, 4, 1, 3], $prioritized->pluck('id')->toArray());
    }

    /** @test */
    public function itKeepsKeysOfTheOriginalCollection()
    {
        $collection = Collection::make([
            [
                'mfr' => 'Apple',
                'name' => 'iPhone Xs',
            ],
            [
                'mfr' => 'Google',
                'name' => 'Pixel 3',
            ],
            [
                'mfr' => 'Microsoft',
                'name' => 'Lumia 950',
            ],
            [
                'mfr' => 'OnePlus',
                'name' => '6T',
            ],
            [
                'mfr' => 'Samsung',
                'name' => 'Galaxy S9',
            ],
        ])->keyBy('mfr');

        $prioritized = $collection->prioritize(function ($phones, $mfr) {
            return in_array($mfr, ['OnePlus', 'Samsung']);
        });
        $this->assertEquals(['OnePlus', 'Samsung', 'Apple', 'Google', 'Microsoft'], $prioritized->keys()->toArray());
    }
}
