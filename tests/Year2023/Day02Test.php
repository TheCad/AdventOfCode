<?php

namespace Thecad\AdventOfCode\Tests\Year2023;

use PHPUnit\Framework\TestCase;
use Thecad\AdventOfCode\Year2023\Day02;

class Day02Test extends TestCase {

    private Day02 $sut;
    protected function setUp(): void {
        parent::setUp();
        $this->sut = new Day02();
        $this->sut->setTestInput([
            'Game 1: 3 blue, 4 red; 1 red, 2 green, 6 blue; 2 green',
            'Game 2: 1 blue, 2 green; 3 green, 4 blue, 1 red; 1 green, 1 blue',
            'Game 3: 8 green, 6 blue, 20 red; 5 blue, 4 red, 13 green; 5 green, 1 red',
            'Game 4: 1 green, 3 red, 6 blue; 3 green, 6 red; 3 green, 15 blue, 14 red',
            'Game 5: 6 red, 1 blue, 3 green; 2 blue, 1 red, 2 green'
        ]);
    }

    public function testPart1(): void {
        $exp = 8;
        $res = $this->sut->partOne();
        self::assertEquals($exp, $res);
    }

    public function testPart2(): void {
        $exp = 2286;
        $res = $this->sut->partTwo();
        self::assertEquals($exp, $res);
    }
}