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

use ArrayObject;
use Hyperf\Utils\Collection;
use HyperfTest\HyperfCollectionMacros\TestCase;
use LengthException;

/**
 * @internal
 * @coversNothing
 */
class TransposeTest extends TestCase
{
    public function transposableCollections(): array
    {
        return [
            'empty' => [
                new Collection(),
                new Collection(),
            ],
            'single-element' => [
                new Collection([
                    ['11'],
                ]),
                new Collection([
                    new Collection(['11']),
                ]),
            ],
            'single-row' => [
                new Collection([
                    ['11', '12', '13'],
                ]),
                new Collection([
                    new Collection(['11']),
                    new Collection(['12']),
                    new Collection(['13']),
                ]),
            ],
            'single-column' => [
                new Collection([
                    ['11'],
                    ['12'],
                    ['13'],
                ]),
                new Collection([
                    new Collection(['11', '12', '13']),
                ]),
            ],
            'tall-rect' => [
                new Collection([
                    ['11', '12'],
                    ['21', '22'],
                    ['31', '32'],
                ]),
                new Collection([
                    new Collection(['11', '21', '31']),
                    new Collection(['12', '22', '32']),
                ]),
            ],
            'wide-rect' => [
                new Collection([
                    ['11', '12', '13'],
                    ['21', '22', '23'],
                ]),
                new Collection([
                    new Collection(['11', '21']),
                    new Collection(['12', '22']),
                    new Collection(['13', '23']),
                ]),
            ],
            'square' => [
                new Collection([
                    ['11', '12', '13'],
                    ['21', '22', '23'],
                    ['31', '32', '33'],
                ]),
                new Collection([
                    new Collection(['11', '21', '31']),
                    new Collection(['12', '22', '32']),
                    new Collection(['13', '23', '33']),
                ]),
            ],
            'arrayable' => [
                new Collection([
                    ['11', '12', '13'],
                    new ArrayObject(['21', '22', '23']),
                    new Collection(['31', '32', '33']),
                ]),
                new Collection([
                    new Collection(['11', '21', '31']),
                    new Collection(['12', '22', '32']),
                    new Collection(['13', '23', '33']),
                ]),
            ],
        ];
    }

    /**
     * @test
     * @dataProvider transposableCollections
     */
    public function itCanTransposeAnArray(Collection $collection, Collection $expected)
    {
        $this->assertEquals($expected, $collection->transpose());
    }

    /** @test */
    public function itWillEnforceLengthEquality()
    {
        $this->expectException(LengthException::class);
        $this->expectExceptionMessage("Element's length must be equal.");

        $collection = new Collection([
            ['11', '12', '13'],
            ['21', '22'],
            ['31', '32', '33'],
        ]);

        $collection->transpose();
    }

    /** @test */
    public function itWillRemoveExistingKeys()
    {
        $collection = new Collection([
            'one' => ['11', '12', '13'],
            'two' => ['21', '22', '23'],
            'three' => ['31', '32', '33'],
        ]);

        $expected = new Collection([
            new Collection(['11', '21', '31']),
            new Collection(['12', '22', '32']),
            new Collection(['13', '23', '33']),
        ]);

        $this->assertEquals($expected, $collection->transpose());
    }

    /** @test */
    public function itCanTransposeASingleRowArray()
    {
        $collection = new Collection([
            ['11', '12', '13'],
        ]);

        $expected = new Collection([
            new Collection(['11']),
            new Collection(['12']),
            new Collection(['13']),
        ]);

        $this->assertEquals($expected, $collection->transpose());
    }

    /** @test */
    public function itCanHandleNullValues()
    {
        $collection = new Collection([
            null,
        ]);

        $expected = new Collection();

        $this->assertEquals($expected, $collection->transpose());
    }

    /** @test */
    public function itCanHandleCollectionsValues()
    {
        $collection = new Collection([
            new Collection([1, 2, 3]),
        ]);

        $expected = new Collection([
            new Collection([1]),
            new Collection([2]),
            new Collection([3]),
        ]);

        $this->assertEquals($expected, $collection->transpose());
    }
}
