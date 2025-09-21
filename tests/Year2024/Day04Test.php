<?php

namespace Thecad\AdventOfCode\Tests\Year2024;

use PHPUnit\Framework\TestCase;
use Thecad\AdventOfCode\Year2024\Day04;

class Day04Test extends TestCase
{
    private Day04 $sut;

    protected function setUp(): void
    {
        parent::setUp();
        $this->sut = new Day04;
    }

    public function test_part1(): void
    {
        $this->sut->partOne();
        self::assertTrue(true);
    }

    public function test_part2(): void
    {
        $this->sut->partTwo();
        self::assertTrue(true);
    }
}
