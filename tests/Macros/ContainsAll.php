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
class ContainsAll extends TestCase
{
    /**
     * @test
     *
     * @dataProvider setTestCases
     */
    public function itReturnsTrueIfTheCollectionContainsAllGivenItems(
        bool $expectedResult,
        array $otherItems
    ) {
        $actualResult = (new Collection(['a', 'b', 'c']))->containsAll($otherItems);

        $this->assertEquals($expectedResult, $actualResult);
    }

    public function setTestCases(): array
    {
        return [
            [false, ['d', 'e']],
            [false, ['c', 'd']],
            [true, ['b', 'c']],
            [true, []],
        ];
    }
}
