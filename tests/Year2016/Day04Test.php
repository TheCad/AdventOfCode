<?php

namespace Thecad\AdventOfCode\Tests\Year2016;

use PHPUnit\Framework\TestCase;
use Thecad\AdventOfCode\Year2016\Day04;

class Day04Test extends TestCase {

    private Day04 $sut;
    protected function setUp(): void {
        parent::setUp();
        $this->sut = new Day04();
    }

    public function testPart1(): void {
        $this->sut->setTestInput(['aaaaa-bbb-z-y-x-123[abxyz]', 'a-b-c-d-e-f-g-h-987[abcde]', 'not-a-real-room-404[oarel]', 'totally-real-room-200[decoy]']);
        $exp = 1514;
        $res = $this->sut->partOne();
        self::assertEquals($exp, $res);
    }

    public function testPart2(): void {
        self::assertTrue(true);
    }
}