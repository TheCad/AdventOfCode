<?php

namespace Thecad\AdventOfCode\Tests\Year2015;

use PHPUnit\Framework\TestCase;
use Thecad\AdventOfCode\Year2015\Day10;

class Day10Test extends TestCase
{

    private Day10 $sut;

    protected function setUp(): void
    {
        parent::setUp();
        $this->sut = new Day10();
    }

    public function testOne(): void
    {
        $this->sut->setTestInput(['1']);
        $actual = $this->sut->partOne();
        $exp = '11';
        self::assertEquals($exp, $actual);
    }

    public function testSecond(): void
    {
        $this->sut->setTestInput(['11']);
        $actual = $this->sut->partOne();
        $exp = '107312';
        self::assertEquals($exp, $actual);
    }

    public function testThird(): void
    {
        $this->sut->setTestInput(['21']);
        $actual = $this->sut->partOne();
        $exp = '139984';
        self::assertEquals($exp, $actual);
    }

    public function testForth(): void
    {
        $this->sut->setTestInput(['1211']);
        $actual = $this->sut->partOne();
        $exp = '182376';
        self::assertEquals($exp, $actual);
    }

    public function testFifth(): void
    {
        $this->sut->setTestInput(['111221']);
        $actual = $this->sut->partOne();
        $exp = '237746';
        self::assertEquals($exp, $actual);
    }

    public function testPart2(): void
    {
        $this->sut->partTwo();
        self::assertTrue(true);
    }
}

