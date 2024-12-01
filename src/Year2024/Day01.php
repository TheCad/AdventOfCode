<?php

namespace Thecad\AdventOfCode\Year2024;

use Thecad\AdventOfCode\Base\BaseClass;

class Day01 extends BaseClass
{
  public $arr1 = array();
  public $arr2 = array();

  public function __construct()
  {
    $this->relativePath = __DIR__;
    parent::__construct();
  }

  private function cleanInput()
  {
    $arr1 = [];
    $arr2 = [];
    array_map(function ($input) use (&$arr1, &$arr2) {
      $split = explode('   ', $input);
      array_push($arr1, $split[0]);
      array_push($arr2, $split[1]);
    }, $this->input);
    return [$arr1, $arr2];
  }

  public function partOne(): int
  {
    [$arr1, $arr2] = $this->cleanInput();
    sort($arr1);
    sort($arr2);
    return array_sum(array_map(fn($a, $b) => abs($a - $b), $arr1, $arr2));
  }

  public function partTwo(): int
  {
    [$arr1, $arr2] = $this->cleanInput();
    return array_sum(array_map(fn($x) => $x * count(array_filter($arr2, fn($y) => $y === $x)), $arr1));
  }
}
