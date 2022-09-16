<?php

namespace Thecad\AdventOfCode\Tests\Year2015;

use PHPUnit\Framework\TestCase;
use Thecad\AdventOfCode\Year2015\Day05;

class Day05Test extends TestCase {

    private Day05 $sut;
    protected function setUp(): void {
        parent::setUp();
        $this->sut = new Day05();
    }

    public function testPart1(): void {
        $this->sut->setTestInput(['ugknbfddgicrmopn', 'aaa', 'jchzalrnumimnmhp', 'haegwjzuvuyypxyu', 'dvszwmarrgswjxmb']);
        $exp = 2;
        $res = $this->sut->partOne();
        self::assertEquals($exp, $res);
    }

    public function testPart1Second(): void {
        $this->sut->setTestInput(['aaa', 'aabcde', 'aedcuu']);
        $exp = 2;
        $res = $this->sut->partOne();
        self::assertEquals($exp, $res);
    }

    public function testPart1illegals(): void {
        $this->sut->setTestInput(['aaa', 'aaac', 'aaacd', 'aaapq', 'aaaxy', 'axyaxya']);
        $exp = 2;
        $res = $this->sut->partOne();
        self::assertEquals($exp, $res);
    }

    public function testPart1Doubles(): void {
        $this->sut->setTestInput(["cacacaa", "cacacca", "cacaca"] );
        $exp = 2;
        $res = $this->sut->partOne();
        self::assertEquals($exp, $res);
    }

    public function testPast1Vowels(): void {
        $this->sut->setTestInput(['aaa', 'bbb', 'eee', 'iii', 'uuu', 'ooo']);
        $exp = 5;
        $res = $this->sut->partOne();
        self::assertEquals($exp, $res);
    }

    public function testPart1Weird(): void {
        $this->sut->setTestInput(['aaa', 'xycjvvsuaxsbrqal']);
        $exp = 1;
        $res = $this->sut->partOne();
        self::assertEquals($exp, $res);
    }

    public function testPart2(): void {
        self::assertTrue(true);
    }
}