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
use Hyperf\Utils\Str;
use HyperfTest\HyperfCollectionMacros\TestCase;

/**
 * @internal
 * @coversNothing
 */
class IfTest extends TestCase
{
    /** @test */
    public function itWillReturnTheRightBranch()
    {
        $this->assertTrue(collect()->if(true, then: true, else: false));
        $this->assertFalse(collect()->if(false, then: true, else: false));
    }

    /**
     * @test
     *
     * @dataProvider sentences
     */
    public function itWillPassTheCollectionToTheBranches(string $sentence, string $modifiedSentence)
    {
        $collection = collect([$sentence])
            ->if(
                fn (Collection $collection) => $collection->contains('this is the value'),
                then: fn (Collection $collection) => $collection->map(fn (string $item) => strtoupper($item)),
                else: fn (Collection $collection) => $collection->map(fn (string $item) => Str::kebab($item))
            );

        $this->assertEquals($modifiedSentence, $collection[0]);
    }

    public function sentences(): array
    {
        return [
            ['this is the value', 'THIS IS THE VALUE'],
            ['this is another value', 'this-is-another-value'],
        ];
    }

    /** @test */
    public function theBranchesAreOptional()
    {
        $result = collect(['this is a value'])
            ->if(
                false,
                then: fn (Collection $collection) => 'something',
            );

        $this->assertNull($result);
    }
}
