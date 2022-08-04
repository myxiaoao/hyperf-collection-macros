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
namespace Cooper\HyperfCollectionMacros;

use Hyperf\Utils\Collection;

class ConfigProvider
{
    public function __invoke(): array
    {
        Collection::make($this->macros())
            ->reject(fn ($class, $macro) => Collection::hasMacro($macro))
            ->each(fn ($class, $macro) => Collection::macro($macro, (new $class())()));

        return [
            'annotations' => [
                'scan' => [
                    'paths' => [
                        __DIR__,
                    ],
                ],
            ],
        ];
    }

    private function macros(): array
    {
        return [
            'after' => \Cooper\HyperfCollectionMacros\Macros\After::class,
            'at' => \Cooper\HyperfCollectionMacros\Macros\At::class,
            'before' => \Cooper\HyperfCollectionMacros\Macros\Before::class,
            'chunkBy' => \Cooper\HyperfCollectionMacros\Macros\ChunkBy::class,
            'collectBy' => \Cooper\HyperfCollectionMacros\Macros\CollectBy::class,
            'eachCons' => \Cooper\HyperfCollectionMacros\Macros\EachCons::class,
            'eighth' => \Cooper\HyperfCollectionMacros\Macros\Eighth::class,
            'extract' => \Cooper\HyperfCollectionMacros\Macros\Extract::class,
            'fifth' => \Cooper\HyperfCollectionMacros\Macros\Fifth::class,
            'filterMap' => \Cooper\HyperfCollectionMacros\Macros\FilterMap::class,
            'firstOrFail' => \Cooper\HyperfCollectionMacros\Macros\FirstOrFail::class,
            'firstOrPush' => \Cooper\HyperfCollectionMacros\Macros\FirstOrPush::class,
            'fourth' => \Cooper\HyperfCollectionMacros\Macros\Fourth::class,
            'fromPairs' => \Cooper\HyperfCollectionMacros\Macros\FromPairs::class,
            'getNth' => \Cooper\HyperfCollectionMacros\Macros\GetNth::class,
            'glob' => \Cooper\HyperfCollectionMacros\Macros\Glob::class,
            'groupByModel' => \Cooper\HyperfCollectionMacros\Macros\GroupByModel::class,
            'head' => \Cooper\HyperfCollectionMacros\Macros\Head::class,
            'if' => \Cooper\HyperfCollectionMacros\Macros\IfMacro::class,
            'ifAny' => \Cooper\HyperfCollectionMacros\Macros\IfAny::class,
            'ifEmpty' => \Cooper\HyperfCollectionMacros\Macros\IfEmpty::class,
            'insertAfter' => \Cooper\HyperfCollectionMacros\Macros\InsertAfter::class,
            'insertAfterKey' => \Cooper\HyperfCollectionMacros\Macros\InsertAfterKey::class,
            'insertAt' => \Cooper\HyperfCollectionMacros\Macros\InsertAt::class,
            'insertBefore' => \Cooper\HyperfCollectionMacros\Macros\InsertBefore::class,
            'insertBeforeKey' => \Cooper\HyperfCollectionMacros\Macros\InsertBeforeKey::class,
            'ninth' => \Cooper\HyperfCollectionMacros\Macros\Ninth::class,
            'none' => \Cooper\HyperfCollectionMacros\Macros\None::class,
            'path' => \Cooper\HyperfCollectionMacros\Macros\Path::class,
            'pluckMany' => \Cooper\HyperfCollectionMacros\Macros\PluckMany::class,
            'pluckToArray' => \Cooper\HyperfCollectionMacros\Macros\PluckToArray::class,
            'prioritize' => \Cooper\HyperfCollectionMacros\Macros\Prioritize::class,
            'range' => \Cooper\HyperfCollectionMacros\Macros\Range::class,
            'recursive' => \Cooper\HyperfCollectionMacros\Macros\Recursive::class,
            'rotate' => \Cooper\HyperfCollectionMacros\Macros\Rotate::class,
            'sortDesc' => \Cooper\HyperfCollectionMacros\Macros\SortDesc::class,
            'skip' => \Cooper\HyperfCollectionMacros\Macros\Skip::class,
            'second' => \Cooper\HyperfCollectionMacros\Macros\Second::class,
            'sectionBy' => \Cooper\HyperfCollectionMacros\Macros\SectionBy::class,
            'seventh' => \Cooper\HyperfCollectionMacros\Macros\Seventh::class,
            'sixth' => \Cooper\HyperfCollectionMacros\Macros\Sixth::class,
            'sliceBefore' => \Cooper\HyperfCollectionMacros\Macros\SliceBefore::class,
            'tail' => \Cooper\HyperfCollectionMacros\Macros\Tail::class,
            'tenth' => \Cooper\HyperfCollectionMacros\Macros\Tenth::class,
            'third' => \Cooper\HyperfCollectionMacros\Macros\Third::class,
            'toPairs' => \Cooper\HyperfCollectionMacros\Macros\ToPairs::class,
            'transpose' => \Cooper\HyperfCollectionMacros\Macros\Transpose::class,
            'weightedRandom' => \Cooper\HyperfCollectionMacros\Macros\WeightedRandom::class,
            'withSize' => \Cooper\HyperfCollectionMacros\Macros\WithSize::class,
        ];
    }
}
