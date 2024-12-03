<?php

namespace Thecad\AdventOfCode\Tests\Year2024;

use PHPUnit\Framework\TestCase;
use Thecad\AdventOfCode\Year2024\Day03;

class Day03Test extends TestCase
{

  private Day03 $sut;
  protected function setUp(): void
  {
    parent::setUp();
    $this->sut = new Day03();
  }

  public function testPart1(): void
  {
    $this->sut->setTestInput(["xmul(2,4)%&mul[3,7]!@^do_not_mul(5,5)+mul(32,64]then(mul(11,8)mul(8,5))"]);
    $actual = $this->sut->partOne();
    $exp = 161;
    self::assertEquals($exp, $actual);
  }

  public function testPart2(): void
  {
    $this->sut->setTestInput(["xmul(2,4)&mul[3,7]!^don't()_mul(5,5)+mul(32,64](mul(11,8)undo()?mul(8,5))"]);
    $actual = $this->sut->partTwo();
    $exp = 48;
    self::assertEquals($exp, $actual);
  }
}
