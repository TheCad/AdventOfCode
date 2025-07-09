<?php

namespace Thecad\AdventOfCode\Year2015;

use Thecad\AdventOfCode\Base\BaseClass;

class Day01 extends BaseClass
{
  public function __construct()
  {
    $this->relativePath = __DIR__;
    parent::__construct();
  }

  public function partOne(): int
  {
    foreach ($this->input as $row) {
      $arr = str_split($row);
      $count = array_count_values($arr);
      $res = $count['('] - $count[')'];
    }
    return $res;
  }

  public function partTwo(): int
  {
    $floorcount = 0;
    $stepcount = 0;
    foreach ($this->input as $row) {
      $arr = str_split($row);
      foreach ($arr as $row2) {
        if ($row2 === '(') {
          $floorcount++;
        } else {
          $floorcount--;
        }

        $stepcount++;
        if ($floorcount < 0) {
          break;
        }
      }
    }
    return $stepcount;
  }
}

