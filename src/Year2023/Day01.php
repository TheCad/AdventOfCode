<?php

namespace Thecad\AdventOfCode\Year2023;

use Thecad\AdventOfCode\Base\BaseClass;

class Day01 extends BaseClass {
    public function __construct() {
        $this->relativePath = __DIR__;
        parent::__construct();
    }

    public function partOne(): int {
        $total = 0;
        foreach ($this->input as $line) {
            $x = preg_replace('/[^0-9]/', '', $line);
            $one = $x[0];
            $one .= $x[strlen($x) - 1];
            $total += intval($one);
        }

        return $total;
    }

    public function partTwo(): int {
        // Create solution

        return 0;
    }
}