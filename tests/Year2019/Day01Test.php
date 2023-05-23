<?php

namespace Thecad\AdventOfCode\Tests\Year2019;

use PHPUnit\Framework\TestCase;
use Thecad\AdventOfCode\Year2019\Day01;

class Day01Test extends TestCase {

    private Day01 $sut;
    protected function setUp(): void {
        parent::setUp();
        $this->sut = new Day01();
    }

    public function testPart1Test1(): void {
        $exp = 2;
        $this->sut->setTestInput(['12']);
        $res = $this->sut->partOne();
        self::assertEquals($exp, $res);
    }

    public function testPart1Test2(): void {
        $exp = 2;
        $this->sut->setTestInput(['14']);
        $res = $this->sut->partOne();
        self::assertEquals($exp, $res);
    }

    public function testPart1Test3(): void {
        $exp = 654;
        $this->sut->setTestInput(['1969']);
        $res = $this->sut->partOne();
        self::assertEquals($exp, $res);
    }

    public function testPart1Test4(): void {
        $exp = 33583;
        $this->sut->setTestInput(['100756']);
        $res = $this->sut->partOne();
        self::assertEquals($exp, $res);
    }

    public function testPart2Test1(): void {
        $exp = 2;
        $this->sut->setTestInput(['14']);
        $res = $this->sut->partTwo();
        self::assertEquals($exp, $res);
    }

    public function testPart2Test2(): void {
        $exp = 966;
        $this->sut->setTestInput(['1969']);
        $res = $this->sut->partTwo();
        self::assertEquals($exp, $res);
    }

    public function testPart2Test3(): void {
        $exp = 50346;
        $this->sut->setTestInput(['100756']);
        $res = $this->sut->partTwo();
        self::assertEquals($exp, $res);
    }
}