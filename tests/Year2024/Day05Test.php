<?php

namespace Thecad\AdventOfCode\Tests\Year2024;

use PHPUnit\Framework\TestCase;
use Thecad\AdventOfCode\Year2024\Day05;

class Day05Test extends TestCase
{

  private Day05 $sut;
  protected function setUp(): void
  {
    parent::setUp();
    $this->sut = new Day05();
  }

  public function testPart1(): void
  {
    $this->sut->setTestInput([

    ])
    $this->sut->partOne();
    self::assertTrue(true);
  }

  public function testPart2(): void
  {
    $this->sut->partTwo();
    self::assertTrue(true);
  }
}

