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
class SectionByTest extends TestCase
{
    /** @test */
    public function itCanSectionACollectionByKey()
    {
        $expected = [
            [
                'Basics', [
                    ['name' => 'Lesson 1', 'module' => 'Basics'],
                    ['name' => 'Lesson 2', 'module' => 'Basics'],
                ],
            ],
            [
                'Advanced', [
                    ['name' => 'Lesson 3', 'module' => 'Advanced'],
                    ['name' => 'Lesson 4', 'module' => 'Advanced'],
                ],
            ],
            [
                'Basics', [
                    ['name' => 'Lesson 5', 'module' => 'Basics'],
                ],
            ],
        ];

        $sections = $this->getDummyCollection()->sectionBy('module');

        $this->assertCount(3, $sections);

        foreach ($expected as $i => $section) {
            $this->assertEquals($section[0], $sections[$i][0]);
            $this->assertEquals($section[1], $sections[$i][1]->toArray());
        }
    }

    /** @test */
    public function itCanUseCustomKeysForTheSectionAndItems()
    {
        $collection = $this->getDummyCollection();

        $sectioned = $collection->sectionBy('module', false, 'section', 'items');

        $expected = [
            [
                'section' => 'Basics',
                'items' => [
                    ['name' => 'Lesson 1', 'module' => 'Basics'],
                    ['name' => 'Lesson 2', 'module' => 'Basics'],
                ],
            ],
            [
                'section' => 'Advanced',
                'items' => [
                    ['name' => 'Lesson 3', 'module' => 'Advanced'],
                    ['name' => 'Lesson 4', 'module' => 'Advanced'],
                ],
            ],
            [
                'section' => 'Basics',
                'items' => [
                    ['name' => 'Lesson 5', 'module' => 'Basics'],
                ],
            ],
        ];

        $this->assertEquals($expected, $sectioned->map(function ($section) {
            $section['items'] = $section['items']->toArray();

            return $section;
        })->toArray());
    }

    /** @test */
    public function itCanPreserveKeys()
    {
        $collection = $this->getDummyCollection();

        $sectioned = $collection->sectionBy('module', true, 'module', 'items');

        $expected = [
            [
                'module' => 'Basics',
                'items' => [
                    'lesson1' => ['name' => 'Lesson 1', 'module' => 'Basics'],
                    'lesson2' => ['name' => 'Lesson 2', 'module' => 'Basics'],
                ],
            ],
            [
                'module' => 'Advanced',
                'items' => [
                    'lesson3' => ['name' => 'Lesson 3', 'module' => 'Advanced'],
                    'lesson4' => ['name' => 'Lesson 4', 'module' => 'Advanced'],
                ],
            ],
            [
                'module' => 'Basics',
                'items' => [
                    'lesson5' => ['name' => 'Lesson 5', 'module' => 'Basics'],
                ],
            ],
        ];

        $this->assertEquals($expected, $sectioned->map(function ($section) {
            $section['items'] = $section['items']->toArray();

            return $section;
        })->toArray());
    }

    protected function getDummyCollection(): Collection
    {
        return Collection::make([
            'lesson1' => ['name' => 'Lesson 1', 'module' => 'Basics'],
            'lesson2' => ['name' => 'Lesson 2', 'module' => 'Basics'],
            'lesson3' => ['name' => 'Lesson 3', 'module' => 'Advanced'],
            'lesson4' => ['name' => 'Lesson 4', 'module' => 'Advanced'],
            'lesson5' => ['name' => 'Lesson 5', 'module' => 'Basics'],
        ]);
    }
}
