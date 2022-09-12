<?php

namespace Thecad\AdventOfCode\Tests\Year2015;

use PHPUnit\Framework\TestCase;
use Thecad\AdventOfCode\Year2015\Day01;

class Day01Test extends TestCase {

    private Day01 $sut;
    protected function setUp(): void {
        parent::setUp();
        $this->sut = new Day01();
    }

    public function testPart1(): void {
        $this->sut->setTestInput(['(())']);
        $exp = 0;
        $res = $this->sut->partOne();
        self::assertEquals($exp, $res);
    }

    public function testPart2(): void {
        $this->sut->setTestInput(['()())']);
        $exp = 5;
        $res = $this->sut->partTwo();
        self::assertEquals($exp, $res);
    }
}