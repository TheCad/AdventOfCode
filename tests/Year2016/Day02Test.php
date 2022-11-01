<?php

namespace Thecad\AdventOfCode\Tests\Year2016;

use PHPUnit\Framework\TestCase;
use Thecad\AdventOfCode\Year2016\Day02;

class Day02Test extends TestCase {

    private Day02 $sut;
    protected function setUp(): void {
        parent::setUp();
        $this->sut = new Day02();
    }

    public function testPart1(): void {
        $this->sut->setTestInput(['ULL', 'RRDDD', 'LURDL', 'UUUUD']);
        $exp = 1985;
        $res = $this->sut->partOne();
        self::assertEquals($exp, $res);
    }

    public function testPart2(): void {
        $this->sut->setTestInput(['ULL', 'RRDDD', 'LURDL', 'UUUUD']);
        $exp = '5DB3';
        $res = $this->sut->partTwo();
        self::assertEquals($exp, $res);
    }
}