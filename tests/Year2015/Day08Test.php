<?php

namespace Thecad\AdventOfCode\Tests\Year2015;

use PHPUnit\Framework\TestCase;
use Thecad\AdventOfCode\Year2015\Day08;

class Day08Test extends TestCase {

    private Day08 $sut;
    protected function setUp(): void {
        parent::setUp();
        $this->sut = new Day08();
    }

    public function testPart1(): void {
        $this->sut->setTestInput(['""', '"abc"', '"aaa\"aaa"', '"\x27"']);
        $exp = 12;
        $res = $this->sut->partOne();
        self::assertEquals($exp, $res);
    }

    public function testPart2(): void {
        self::assertTrue(true);
    }
}