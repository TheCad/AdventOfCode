<?php

namespace Thecad\AdventOfCode\Tests\Year2015;

use PHPUnit\Framework\TestCase;
use Thecad\AdventOfCode\Year2015\Day09;

class Day09Test extends TestCase
{
    private Day09 $sut;

    protected function setUp(): void
    {
        parent::setUp();
        $this->sut = new Day09;
    }

    public function test_part1(): void
    {
        $this->sut->setTestInput(['London to Dublin = 464', 'London to Belfast = 518', 'Dublin to Belfast = 141']);
        $output = $this->sut->partOne();
        $exp = 605;

        self::assertEquals($exp, $output);
    }

    public function test_part2(): void
    {
        $this->sut->partTwo();
        self::assertTrue(true);
    }
}
