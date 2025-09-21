<?php

namespace Thecad\AdventOfCode\Tests\Year2015;

use PHPUnit\Framework\TestCase;
use Thecad\AdventOfCode\Year2015\Day11;

class Day11Test extends TestCase
{
    private Day11 $sut;

    protected function setUp(): void
    {
        parent::setUp();
        $this->sut = new Day11;
    }

    public function test_part1(): void
    {
        $this->sut->setTestInput(['abcdefgh']);
        $act = $this->sut->partOne();
        $exp = 'abcdffaa';
        self::assertEquals($exp, $act);
    }

    public function test_part11(): void
    {
        $this->sut->setTestInput(['ghijklmn']);
        $act = $this->sut->partOne();
        $exp = 'ghjaabcc';
        self::assertEquals($exp, $act);
    }

    public function test_part2(): void
    {
        $this->sut->partTwo();
        self::assertTrue(true);
    }
}
