<?php

namespace Thecad\AdventOfCode\Year2019;

use Thecad\AdventOfCode\Base\BaseClass;

class Day01 extends BaseClass {
    public function __construct() {
        $this->relativePath = __DIR__;
        parent::__construct();
    }

    public function partOne(): int {
        // Create solution
        $total = 0;

        foreach ($this->input as $line) {
            $total += $this->calculate($line);
        }

        return $total;
    }

    private function calculate($mass) {
        return floor($mass / 3) - 2;
    }

    private function calculateRec($mass) {
        $fuel = $this->calculate($mass);
        if ($fuel <= 0) {
            return null;
        }
        return $fuel + $this->calculateRec($fuel);
    }

    public function partTwo(): int {
        // Create solution
        $total = 0;
        foreach ($this->input as $line) {
            $total += $this->calculateRec($line);
        }
        return $total;
    }
}