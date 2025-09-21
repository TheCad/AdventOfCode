<?php

namespace Thecad\AdventOfCode\Tests\Year2016;

use PHPUnit\Framework\TestCase;
use Thecad\AdventOfCode\Year2016\Day01;

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
        $this->sut->setTestInput(['R2, L3']);
        $exp = 5;
        $res = $this->sut->partOne();
        self::assertEquals($exp, $res);
    }

    public function test_part1_second()
    {
        $this->sut->setTestInput(['R2, R2, R2']);
        $exp = 2;
        $res = $this->sut->partOne();
        self::assertEquals($exp, $res);
    }

    public function test_part1_third()
    {
        $this->sut->setTestInput(['R5, L5, R5, R3']);
        $exp = 12;
        $res = $this->sut->partOne();
        self::assertEquals($exp, $res);
    }

    //    public function testPart2(): void {
    //        $this->sut->setTestInput(['R8, R4, R4, R8']);
    //        $exp = 4;
    //        $res = $this->sut->partTwo();
    //        self::assertEquals($exp, $res);
    //    }

    public function test_part2_second(): void
    {
        $this->sut->setTestInput(['R8, L2, R1, R4, L1, L3, L4']);
        $exp = 10;
        $res = $this->sut->partTwo();
        self::assertEquals($exp, $res);
    }
}
