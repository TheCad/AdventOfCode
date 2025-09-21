<?php

namespace Thecad\AdventOfCode\Tests\Year2015;

use PHPUnit\Framework\TestCase;
use Thecad\AdventOfCode\Year2015\Day02;

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
        $this->sut->setTestInput(['2x3x4']);
        $exp = 58;
        $res = $this->sut->partOne();
        self::assertEquals($exp, $res);
    }

    public function test_part1_second(): void
    {
        $this->sut->setTestInput(['1x1x10']);
        $exp = 43;
        $res = $this->sut->partOne();
        self::assertEquals($exp, $res);
    }

    public function test_part2(): void
    {
        $this->sut->setTestInput(['2x3x4']);
        $exp = 34;
        $res = $this->sut->partTwo();
        self::assertEquals($exp, $res);
    }

    public function test_part2_second(): void
    {
        $this->sut->setTestInput(['1x1x10']);
        $exp = 14;
        $res = $this->sut->partTwo();
        self::assertEquals($exp, $res);
    }

    public function test_part2_third(): void
    {
        $this->sut->setTestInput(['2x3x4', '1x1x10', '2x3x4', '10x12x15']); // 34 14 34 1844
        $exp = 1926;
        $res = $this->sut->partTwo();
        self::assertEquals($exp, $res);
    }
}
