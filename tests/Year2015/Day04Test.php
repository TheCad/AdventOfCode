<?php

namespace Thecad\AdventOfCode\Tests\Year2015;

use PHPUnit\Framework\TestCase;
use Thecad\AdventOfCode\Year2015\Day04;

class Day04Test extends TestCase
{
    private Day04 $sut;

    protected function setUp(): void
    {
        parent::setUp();
        $this->sut = new Day04;
    }

    public function test_part1(): void
    {
        $this->sut->setTestInput(['abcdef']);
        $exp = 609043;
        $res = $this->sut->partOne();

        self::assertEquals($exp, $res);
    }

    public function test_part1_second(): void
    {
        $this->sut->setTestInput(['pqrstuv']);
        $exp = 1048970;
        $res = $this->sut->partOne();

        self::assertEquals($exp, $res);
    }
}
