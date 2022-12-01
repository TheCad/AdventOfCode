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
        $this->resetTotal();
        $this->countCals();
        return max($this->totals);
    }

    public function partTwo(): int {
        // Create solution
        $this->resetTotal();
        $this->countCals();
        rsort($this->totals);
        return $this->totals[0] + $this->totals[1] + $this->totals[2];
    }

    private function resetTotal() {
        $this->totals = [];
    }

    private function countCals() {
        $x = 0;
        foreach ($this->input as $line) {
            if ($line === '') {
                array_push($this->totals, $x);
                $x = 0;
            }
            $x += (int)$line;
        }
        array_push($this->totals, $x);
    }
}
