<?php

namespace Thecad\AdventOfCode\Tests\Year2015;

use PHPUnit\Framework\TestCase;
use Thecad\AdventOfCode\Year2015\Day03;

class Day03Test extends TestCase {

    private Day03 $sut;
    protected function setUp(): void {
        parent::setUp();
        $this->sut = new Day03();
    }

    public function testPart1(): void {
        $this->sut->setTestInput(['>']);
        $exp = 2;
        $res = $this->sut->partOne();
        self::assertEquals($exp, $res);
    }

    public function testPart1Second(): void {
        $this->sut->setTestInput(['^>V<']);
        $exp = 4;
        $res = $this->sut->partOne();
        self::assertEquals($exp, $res);
    }

    public function testPart1Third(): void {
        $this->sut->setTestInput(['^V^V^V^V^V']);
        $exp = 2;
        $res = $this->sut->partOne();
        self::assertEquals($exp, $res);
    }

    public function testPart2(): void {
        self::assertTrue(true);
    }
}