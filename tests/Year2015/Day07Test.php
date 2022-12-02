<?php

namespace Thecad\AdventOfCode\Tests\Year2015;

use PHPUnit\Framework\TestCase;
use Thecad\AdventOfCode\Year2015\Day07;

class Day07Test extends TestCase {

    private Day07 $sut;
    protected function setUp(): void {
        parent::setUp();
        $this->sut = new Day07();
    }

    public function testPart1(): void {
        $this->sut->setTestInput(['123 -> x', '456 -> y', 'x AND y -> d', 'x OR y -> e', 'x LSHIFT 2 -> f', 'y RSHIFT 2 -> g', 'NOT x -> h', 'NOT y -> i']);
        $exp = 507;
        $res = $this->sut->partOne();
        self::assertEquals($exp, $res);
    }

    public function testPart2(): void {
        self::assertTrue(true);
    }
}
