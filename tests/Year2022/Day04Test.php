<?php

namespace Thecad\AdventOfCode\Tests\Year2022;

use PHPUnit\Framework\TestCase;
use Thecad\AdventOfCode\Year2022\Day04;

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
        $this->sut->setTestInput(['2-4,6-8', '2-3,4-5', '5-7,7-9', '2-8,3-7', '6-6,4-6', '2-6,4-8']);
        $exp = 2;
        $res = $this->sut->partOne();
        self::assertEquals($exp, $res);
    }

    public function test_part2(): void
    {
        self::assertTrue(true);
    }
}
