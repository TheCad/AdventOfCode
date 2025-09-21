<?php

namespace Thecad\AdventOfCode\Tests\Year2022;

use PHPUnit\Framework\TestCase;
use Thecad\AdventOfCode\Year2022\Day02;

class Day02Test extends TestCase
{
    private Day02 $sut;

    protected function setUp(): void
    {
        parent::setUp();
        $this->sut = new Day02;
    }

    public function test_part1(): void
    {
        $this->sut->setTestInput(['A Y', 'B X', 'C Z']);
        $exp = 15;
        $res = $this->sut->partOne();
        self::assertEquals($exp, $res);
    }

    public function test_part2(): void
    {
        self::assertTrue(true);
    }
}
