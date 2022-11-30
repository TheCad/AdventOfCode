<?php

namespace Thecad\AdventOfCode\Year2021;

use Thecad\AdventOfCode\Base\BaseClass;

class Day01 extends BaseClass {
    public function __construct() {
        $this->relativePath = __DIR__;
        parent::__construct();
    }

    public function partOne(): int {
        $increments = 0;
        for ($i = 0; $i < count($this->input); $i++) {
            if ($i == count($this->input) - 1)
                break;
            if ($this->input[$i+1] > $this->input[$i])
                $increments++;
        }
        return $increments;
    }

    public function partTwo(): int {
        $increments = 0;
        for ($i = 0; $i < count($this->input); $i++) {
            if ($i >= count($this->input) - 3){
                break;
            }
            $sum1 = $this->input[$i] + $this->input[$i+1] + $this->input[$i+2];
            $sum2 = $this->input[$i+1] + $this->input[$i+2] + $this->input[$i+3];

            if ($sum2 > $sum1)
                $increments++;
        }

        return $increments;
    }
}