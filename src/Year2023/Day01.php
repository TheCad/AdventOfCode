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
        $list = ['zero', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'];
        $total = 0;
        foreach ($this->input as $line) {
            if (preg_match_all('/(?=(one|two|three|four|five|six|seven|eight|nine|[0-9]))/', $line, $matches)) {
                $c = count($matches[1]) - 1;
                if (intval($matches[1][0]) === 0)
                    $first = array_search($matches[1][0], $list);
                else
                    $first = $matches[1][0];
                if (intval($matches[1][$c]) === 0)
                    $second = array_search($matches[1][$c], $list);
                else
                    $second = $matches[1][$c];

                $num = $first.$second;
                $total += intval($num);
            }
        }
        return $total;
    }
}