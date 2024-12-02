<?php

namespace Thecad\AdventOfCode\Tests\Year2024;

use PHPUnit\Framework\TestCase;
use Thecad\AdventOfCode\Year2024\Day01;

class Day01Test extends TestCase
{

  private Day01 $sut;
  protected function setUp(): void
  {
    parent::setUp();
    $this->sut = new Day01();
    $this->sut->setTestInput(["3   4", "4   3", "2   5", "1   3", "3   9", "3   3"]);
  }

  public function testPart1(): void
  {
    $actual = $this->sut->partOne();
    $exp = 11;
    self::assertEquals($exp, $actual);
  }

  public function testPart2(): void
  {
    $actual = $this->sut->partTwo();
    $exp = 31;
    self::assertEquals($exp, $actual);
  }

  public function testPart2_1(): void
  {
    $this->sut->setTestInput(["3   4", "4   3", "2   5", "1   3", "3   9", "3   3", "3   3"]);
    $actual = $this->sut->partTwo();
    $exp = 52;
    self::assertEquals($exp, $actual);
  }
}
