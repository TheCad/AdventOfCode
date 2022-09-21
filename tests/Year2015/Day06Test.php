<?php

namespace Thecad\AdventOfCode\Tests\Year2015;

use PHPUnit\Framework\TestCase;
use Thecad\AdventOfCode\Year2015\Day06;

class Day06Test extends TestCase {

    private Day06 $sut;
    protected function setUp(): void {
        parent::setUp();
        $this->sut = new Day06();
    }

    public function testPart1(): void {
        $this->sut->setTestInput(['turn on 0,0 through 999,999']);
        $exp = 1000000;
        $res = $this->sut->partOne();
        self::assertEquals($exp, $res);
    }

    public function testPart1Second(): void {
        $this->sut->setTestInput(['toggle 0,0 through 999,0']);
        $exp = 1000;
        $res = $this->sut->partOne();
        self::assertEquals($exp, $res);
    }

    public function testPart1Third(): void {
        $this->sut->setTestInput(['turn on 0,0 through 999,999', 'turn off 499,499 through 500,500']);
        $exp = 999996;
        $res = $this->sut->partOne();
        self::assertEquals($exp, $res);
    }

    public function testPart2(): void {
        $this->sut->setTestInput(['turn on 0,0 through 0,0']);
        $exp = 1;
        $res = $this->sut->partTwo();
        self::assertEquals($exp, $res);
    }

    public function testPart2Second(): void {
        $this->sut->setTestInput(['toggle 0,0 through 999,999']);
        $exp = 2000000;
        $res = $this->sut->partTwo();
        self::assertEquals($exp, $res);
    }
}