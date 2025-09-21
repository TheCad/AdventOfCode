<?php

namespace Thecad\AdventOfCode\Tests\Year2022;

use PHPUnit\Framework\TestCase;
use Thecad\AdventOfCode\Year2022\Day05;

class Day05Test extends TestCase
{
    private Day05 $sut;

    protected function setUp(): void
    {
        parent::setUp();
        $this->sut = new Day05;
        $this->sut->setStack([['N', 'Z'], ['D', 'C', 'M'], ['P']]);
    }

    public function test_part1(): void
    {
        $this->sut->setTestInput(['move 1 from 2 to 1', 'move 3 from 1 to 3', 'move 2 from 2 to 1', 'move 1 from 1 to 2']);
        $exp = 'CMZ';
        $res = $this->sut->partOne();
        self::assertEquals($exp, $res);
    }

    public function test_part2(): void
    {
        $this->sut->setTestInput(['move 1 from 2 to 1', 'move 3 from 1 to 3', 'move 2 from 2 to 1', 'move 1 from 1 to 2']);
        $exp = 'MCD';
        $res = $this->sut->partTwo();
        self::assertEquals($exp, $res);
    }
}
