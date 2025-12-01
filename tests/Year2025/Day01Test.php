<?php

namespace Thecad\AdventOfCode\Tests\Year2025;

use PHPUnit\Framework\TestCase;
use Thecad\AdventOfCode\Year2025\Day01;

class Day01Test extends TestCase
{
    private Day01 $sut;

    protected function setUp(): void
    {
        parent::setUp();
        $this->sut = new Day01;
    }

    public function test_part1(): void
    {
        $this->sut->setTestInput(['L68', 'L30', 'R48', 'L5', 'R60', 'L55', 'L1', 'L99', 'R14', 'L82']);
        $actual = $this->sut->partOne();
        $exp = 3;
        self::assertEquals($exp, $actual);
    }

    public function test_part2(): void
    {
        $this->sut->setTestInput(['R1000', 'L1000', 'L50']);
        $actual = $this->sut->partTwo();
        $exp = 21;
        self::assertEquals($exp, $actual);
    }

    public function test_part2_1(): void
    {
        $this->sut->setTestInput(['L68', 'L30', 'R48', 'L5', 'R60', 'L55', 'L1', 'L99', 'R14', 'L82']);
        $actual = $this->sut->partTwo();
        $exp = 6;
        self::assertEquals($exp, $actual);
    }
}
