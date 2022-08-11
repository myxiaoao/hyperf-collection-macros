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
use Illuminate\Database\Eloquent\Model;
use Mockery;

/**
 * @internal
 * @coversNothing
 */
class GroupByModelTest extends TestCase
{
    /** @test */
    public function itCanGroupACollectionByAModelWithACallable()
    {
        [$model1, $model2, $collection] = $this->getDummies();

        $expected = [
            [
                $model1, [
                    ['model' => $model1, 'foo' => 'bar'],
                    ['model' => $model1, 'foo' => 'baz'],
                ],
            ],
            [
                $model2, [
                    ['model' => $model2, 'foo' => 'qux'],
                ],
            ],
        ];

        $grouped = $collection->groupByModel(function ($item) {
            return $item['model'];
        });

        $this->assertCount(2, $grouped);

        foreach ($expected as $i => $group) {
            $this->assertEquals($group[0], $grouped[$i][0]);
            $this->assertEquals($group[1], $grouped[$i][1]->toArray());
        }
    }

    /** @test */
    public function itCanGroupACollectionByAModelWithACallableAndCustomKeyNames()
    {
        [$model1, $model2, $collection] = $this->getDummies();

        $grouped = $collection->groupByModel(function ($item) {
            return $item['model'];
        }, false, 'myKey', 'items');

        $expected = [
            [
                'myKey' => $model1,
                'items' => [
                    ['model' => $model1, 'foo' => 'bar'],
                    ['model' => $model1, 'foo' => 'baz'],
                ],
            ],
            [
                'myKey' => $model2,
                'items' => [
                    ['model' => $model2, 'foo' => 'qux'],
                ],
            ],
        ];

        $this->assertEquals($expected, $grouped->map(function ($group) {
            $group['items'] = $group['items']->toArray();

            return $group;
        })->toArray());
    }

    /** @test */
    public function itCanGroupACollectionByAModelWithAKey()
    {
        [$model1, $model2, $collection] = $this->getDummies();

        $grouped = $collection->groupByModel('model');

        $expected = [
            [
                $model1, [
                    ['model' => $model1, 'foo' => 'bar'],
                    ['model' => $model1, 'foo' => 'baz'],
                ],
            ],
            [
                $model2, [
                    ['model' => $model2, 'foo' => 'qux'],
                ],
            ],
        ];

        $this->assertCount(2, $grouped);

        foreach ($expected as $i => $group) {
            $this->assertEquals($group[0], $grouped[$i][0]);
            $this->assertEquals($group[1], $grouped[$i][1]->toArray());
        }
    }

    /** @test */
    public function itCanGroupACollectionByAModelWithAKeyAndCustomKeyNames()
    {
        [$model1, $model2, $collection] = $this->getDummies();

        $grouped = $collection->groupByModel('model', false, 'myKey', 'items');

        $expected = [
            [
                'myKey' => $model1,
                'items' => [
                    ['model' => $model1, 'foo' => 'bar'],
                    ['model' => $model1, 'foo' => 'baz'],
                ],
            ],
            [
                'myKey' => $model2,
                'items' => [
                    ['model' => $model2, 'foo' => 'qux'],
                ],
            ],
        ];

        $this->assertEquals($expected, $grouped->map(function ($group) {
            $group['items'] = $group['items']->toArray();

            return $group;
        })->toArray());
    }

    /** @test */
    public function itCanGroupACollectionByAModelWithAKeyAndACustomItemsKey()
    {
        [$model1, $model2, $collection] = $this->getDummies();

        $grouped = $collection->groupByModel('model', false, 'model', 'myItems');

        $expected = [
            [
                'model' => $model1,
                'myItems' => [
                    ['model' => $model1, 'foo' => 'bar'],
                    ['model' => $model1, 'foo' => 'baz'],
                ],
            ],
            [
                'model' => $model2,
                'myItems' => [
                    ['model' => $model2, 'foo' => 'qux'],
                ],
            ],
        ];

        $this->assertEquals($expected, $grouped->map(function ($group) {
            $group['myItems'] = $group['myItems']->toArray();

            return $group;
        })->toArray());
    }

    /** @test */
    public function itCanGroupACollectionByAModelAndPreserveKeys()
    {
        [$model1, $model2, $collection] = $this->getDummies();

        $grouped = $collection->groupByModel('model', true, 'model', 'items');

        $expected = [
            [
                'model' => $model1,
                'items' => [
                    'dummy1' => ['model' => $model1, 'foo' => 'bar'],
                    'dummy2' => ['model' => $model1, 'foo' => 'baz'],
                ],
            ],
            [
                'model' => $model2,
                'items' => [
                    'dummy3' => ['model' => $model2, 'foo' => 'qux'],
                ],
            ],
        ];

        $this->assertEquals($expected, $grouped->map(function ($group) {
            $group['items'] = $group['items']->toArray();

            return $group;
        })->toArray());
    }

    protected function getDummies(): array
    {
        $model1 = Mockery::mock(Model::class);
        $model1->shouldReceive('getKey')->andReturn(1);

        $model2 = Mockery::mock(Model::class);
        $model2->shouldReceive('getKey')->andReturn(2);

        $collection = Collection::make([
            'dummy1' => ['model' => $model1, 'foo' => 'bar'],
            'dummy2' => ['model' => $model1, 'foo' => 'baz'],
            'dummy3' => ['model' => $model2, 'foo' => 'qux'],
        ]);

        return [$model1, $model2, $collection];
    }
}
