<?php

namespace Thecad\AdventOfCode\Tests\Year2022;

use PHPUnit\Framework\TestCase;
use Thecad\AdventOfCode\Year2022\Day06;

class Day06Test extends TestCase {

    private Day06 $sut;
    protected function setUp(): void {
        parent::setUp();
        $this->sut = new Day06();
    }

    public function testPart1(): void {
        $this->sut->setTestInput(["bvwbjplbgvbhsrlpgdmjqwftvncz"]);
        $exp = 5;
        $res = $this->sut->partOne();
        self::assertEquals($exp, $res);
    }

    public function testPart2(): void {
        self::assertTrue(true);
    }
}
