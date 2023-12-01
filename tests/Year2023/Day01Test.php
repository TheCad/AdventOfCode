<?php

namespace Thecad\AdventOfCode\Tests\Year2023;

use PHPUnit\Framework\TestCase;
use Thecad\AdventOfCode\Year2023\Day01;

class Day01Test extends TestCase {

    private Day01 $sut;
    protected function setUp(): void {
        parent::setUp();
        $this->sut = new Day01();
        $this->sut->setTestInput(['1abc2', 'pqr3stu8vwx', 'a1b2c3d4e5f', 'treb7uchet']);
    }

    public function testPart1(): void {
        $exp = 142;
        $res = $this->sut->partOne();
        self::assertEquals($exp, $res);
    }

    public function testPart2(): void {
        self::assertTrue(true);
    }
}