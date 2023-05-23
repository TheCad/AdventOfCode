<?php

namespace Thecad\AdventOfCode\Year2019;

use Thecad\AdventOfCode\Base\BaseClass;

class Day01 extends BaseClass {
    public function __construct() {
        $this->relativePath = __DIR__;
        parent::__construct();
    }

    public function partOne(): int {
        $total = 0;
        foreach ($this->input as $line) {
            $total += $this->calculateFuel($line);
        }
        return $total;
    }

    private function calculateFuel(int $input): int {
        return floor($input / 3) - 2;
    }

    public function partTwo(): int {
        $total = 0;
        foreach ($this->input as $line) {
            $total += $this->calculateFuelRecursive($line);
        }
        return $total;
    }

    private function calculateFuelRecursive(int $input): int|null {
        $fuel = $this->calculateFuel($input);
        if ($fuel <= 0)
            return null;
        return $fuel + $this->calculateFuelRecursive($fuel);

    }
}