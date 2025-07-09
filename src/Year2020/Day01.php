<?php

namespace Thecad\AdventOfCode\Year2020;

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
    $count = count($this->input);
    for ($i = 0; $i < $count; $i++) {
      for ($j = 0; $j < $count; $j++) {
        if ($this->input[$i] + $this->input[$j] === 2020) {
          echo intval($this->input[$i]) . ' combined with ' . intval($this->input[$j]) . ' equals 2020' . PHP_EOL;
          return $this->input[$i] * $this->input[$j];
        }
      }
    }
    return 0;
  }

  public function partTwo(): int
  {
    $count = count($this->input);
    for ($i = 0; $i < $count; $i++) {
      for ($j = 0; $j < $count; $j++) {
        for ($z = 0; $z < $count; $z++) {
          if (($this->input[$i] + $this->input[$j] + $this->input[$z]) === 2020) {
            echo intval($this->input[$i]) . ' combined with ' . intval($this->input[$j]) . ' combined with ' . intval($this->input[$z]) . ' equals 2020' . PHP_EOL;
            return $this->input[$i] * $this->input[$j] * $this->input[$z];
          }
        }
      }
    }
    return 0;
  }
}

