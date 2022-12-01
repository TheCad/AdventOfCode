<?php

namespace Thecad\AdventOfCode\Tests\Year2022;

use PHPUnit\Framework\TestCase;
use Thecad\AdventOfCode\Year2022\Day01;

class Day01Test extends TestCase {

    private Day01 $sut;
    protected function setUp(): void {
        parent::setUp();
        $this->sut = new Day01();
    }

    public function testPart1(): void {
        $this->sut->setTestInput(["1000", "2000", "3000", "", "4000", "", "5000", "6000", "", "7000", "8000", "9000", "", "10000"]);
        $exp = 24000;
        $res = $this->sut->partOne();
        self::assertEquals($exp, $res);
    }

    public function testPart2(): void {
        self::assertTrue(true);
    }
}
