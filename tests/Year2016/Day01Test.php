<?php

namespace Thecad\AdventOfCode\Tests\Year2016;

use PHPUnit\Framework\TestCase;
use Thecad\AdventOfCode\Year2016\Day01;

class Day01Test extends TestCase {

    private Day01 $sut;
    protected function setUp(): void {
        parent::setUp();
        $this->sut = new Day01();
    }

    public function testPart1(): void {
        $this->sut->setTestInput(['R2, L3']);
        $exp = 5;
        $res = $this->sut->partOne();
        self::assertEquals($exp, $res);
    }

    public function testPart1Second() {
        $this->sut->setTestInput(['R2, R2, R2']);
        $exp = 2;
        $res = $this->sut->partOne();
        self::assertEquals($exp, $res);
    }

    public function testPart1Third() {
        $this->sut->setTestInput(['R5, L5, R5, R3']);
        $exp = 12;
        $res = $this->sut->partOne();
        self::assertEquals($exp, $res);
    }

    public function testPart2(): void {
        $this->sut->setTestInput(['R8, R4, R4, R8']);
        $exp = 4;
        $res = $this->sut->partTwo();
        \PHPUnit\Framework\assertEquals($exp, $res);
    }
}