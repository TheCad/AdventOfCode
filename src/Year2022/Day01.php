<?php

namespace Thecad\AdventOfCode\Year2022;

use Thecad\AdventOfCode\Base\BaseClass;

class Day01 extends BaseClass {
    public array $totals = [];
    public function __construct() {
        $this->relativePath = __DIR__;
        parent::__construct();
    }

    public function partOne(): int {
        // Create solution
        $x = 0;
        foreach ($this->input as $line) {
            if ($line === '') {
                array_push($this->totals, $x);
                $x = 0;
            }
            $x += (int)$line;
        }
        array_push($this->totals, $x);

        return max($this->totals);
    }

    public function partTwo(): int {
        // Create solution
        $this->totals = [];
        $x = 0;
        foreach($this->input as $line) {
            if ($line === '') {
                array_push($this->totals, $x);
                $x = 0;
            }
            $x += (int)$line;
        }
        array_push($this->totals, $x);
        rsort($this->totals);
        $sum = $this->totals[0] + $this->totals[1] + $this->totals[2];

        return $sum;
    }
}
