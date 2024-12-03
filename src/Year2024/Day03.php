<?php

namespace Thecad\AdventOfCode\Year2024;

use Thecad\AdventOfCode\Base\BaseClass;

class Day03 extends BaseClass
{
  public function __construct()
  {
    $this->relativePath = __DIR__;
    parent::__construct();
  }

  public function partOne(): int
  {
    // Create solution
    $matcharr = [];
    $total = 0;
    $regex = "/mul\((\d{1,3}),(\d{1,3})\)/";

    preg_match_all($regex, $this->input[0], $matcharr);

    for ($i = 0; $i < count($matcharr[0]); $i++) {
      $total += ($matcharr[1][$i] * $matcharr[2][$i]);
    }

    return $total;
  }

  public function partTwo(): int
  {
    $matcharr = [];
    $total = 0;
    $regex = "/mul\((\d{1,3}),(\d{1,3})\)|do\(\)|don't\(\)/";

    preg_match_all($regex, $this->input[0], $matcharr);
    $matching = true;


    for ($i = 0; $i < count($matcharr[0]); $i++) {
      if ($matcharr[0][$i] == "don't()") {
        $matching = false;
      } else if ($matcharr[0][$i] == "do()") {
        $matching = true;
      } else {
        if ($matching) {
          if ($matcharr[1][$i] == "") continue;
          $total += ($matcharr[1][$i] * $matcharr[2][$i]);
        }
      }
    }
    return $total;
  }
}
