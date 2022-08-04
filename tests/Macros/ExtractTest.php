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
class ExtractTest extends TestCase
{
    /** @var Collection */
    private $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = collect([
            'name' => 'Sebastian',
            'company' => 'Spatie',
            'role' => [
                'name' => 'Developer',
            ],
        ]);
    }

    /** @test */
    public function itProvidesAnExtractMacro()
    {
        $this->assertTrue(Collection::hasMacro('extract'));
    }

    /** @test */
    public function itCanExtractAKey()
    {
        $this->assertEquals(['Sebastian'], $this->user->extract('name')->toArray());
    }

    /** @test */
    public function itCanExtractMultipleKeys()
    {
        $this->assertEquals(['Sebastian', 'Spatie'], $this->user->extract('name', 'company')->toArray());
    }

    /** @test */
    public function itCanExtractMultipleKeysWithAnArray()
    {
        $this->assertEquals(['Sebastian', 'Spatie'], $this->user->extract(['name', 'company'])->toArray());
    }

    /** @test */
    public function itCanExtractNestedKeys()
    {
        $this->assertEquals(['Sebastian', 'Developer'], $this->user->extract('name', 'role.name')->toArray());
    }

    /** @test */
    public function itExtractsNullWhenAKeysDoesntExist()
    {
        $this->assertEquals([null, 'Sebastian'], $this->user->extract('id', 'name')->toArray());
    }
}
