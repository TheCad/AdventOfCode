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
      if ($this->isSafe($row)) $total++;
    }

    return $total;
  }

  private function isSafe($row): bool
  {
    $safe = true;
    $ex = explode(' ', $row);

    if ($ex[0] != $ex[1]) {
      $isAscending = $ex[0] < $ex[1];
      for ($i = 0; $i < count($ex) - 1; $i++) {
        if (($isAscending && $ex[$i] >= $ex[$i + 1]) || (!$isAscending && $ex[$i] <= $ex[$i + 1])) {
          $safe = false;
          break;
        }
      }
    } else {
      $safe = false;
    }

    for ($i = 0; $i < count($ex) - 1; $i++) {
      if (abs($ex[$i] - $ex[$i + 1]) < 1 || abs($ex[$i] - $ex[$i + 1]) > 3) {
        $safe = false;
        break;
      }
    }
    return $safe;
  }

  public function partTwo(): int
  {
    // Create solution

    return 0;
  }
}
