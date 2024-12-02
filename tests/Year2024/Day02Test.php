<?php

namespace Thecad\AdventOfCode\Tests\Year2024;

use PHPUnit\Framework\TestCase;
use Thecad\AdventOfCode\Year2024\Day02;

class Day02Test extends TestCase
{

  private Day02 $sut;
  protected function setUp(): void
  {
    parent::setUp();
    $this->sut = new Day02();
    $this->sut->setTestInput(["7 6 4 2 1", "1 2 7 8 9", "9 7 6 2 1", "1 3 2 4 5", "8 6 4 4 1", "1 3 6 7 9"]);
  }

  public function testPart1(): void
  {
    $actual = $this->sut->partOne();
    $exp = 2;
    self::assertEquals($exp, $actual);
  }

  public function testPart2(): void
  {
    $actual = $this->sut->partTwo();
    $exp = 4;
    self::assertEquals($exp, $actual);
  }
}
