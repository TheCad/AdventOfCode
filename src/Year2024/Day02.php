<?php

namespace Thecad\AdventOfCode\Year2024;

use Thecad\AdventOfCode\Base\BaseClass;

class Day02 extends BaseClass
{
  public function __construct()
  {
    $this->relativePath = __DIR__;
    parent::__construct();
  }

  public function partOne(): int
  {
    $total = 0;
    foreach ($this->input as $row) {
      $ex = explode(' ', $row);
      if ($this->isValid($ex)) $total++;
    }

    return $total;
  }

  public function partTwo(): int
  {
    $total = 0;
    foreach ($this->input as $row) {
      if ($this->isSafeTwo($row)) $total++;
    }

    return $total;
  }

  private function isSafeTwo($row): bool
  {
    $ex = explode(' ', $row);

    if ($this->isValid($ex)) {
      return true;
    }

    for ($removeIndex = 0; $removeIndex < count($ex); $removeIndex++) {
      $newEx = array_values(array_merge(array_slice($ex, 0, $removeIndex), array_slice($ex, $removeIndex + 1)));

      if ($this->isValid($newEx)) {
        return true;
      }
    }

    return false;
  }

  private function isValid(array $arr): bool
  {
    if (count($arr) < 2) {
      return false;
    }

    $isIncreasing = true;
    $isDecreasing = true;

    for ($i = 0; $i < count($arr) - 1; $i++) {
      $diff = abs($arr[$i] - $arr[$i + 1]);

      if ($diff < 1 || $diff > 3) {
        return false;
      }

      if ($arr[$i] >= $arr[$i + 1]) {
        $isIncreasing = false;
      }
      if ($arr[$i] <= $arr[$i + 1]) {
        $isDecreasing = false;
      }
    }

    return $isIncreasing || $isDecreasing;
  }
}
