<?php

namespace Thecad\AdventOfCode\Year2015;

use Thecad\AdventOfCode\Base\BaseClass;

class Day02 extends BaseClass {
    public function __construct() {
        $this->relativePath = __DIR__;
        parent::__construct();
    }

    public function partOne(): int {
        $total = 0;

        foreach($this->input as $row) {
            $arr = explode('x', $row);
            [$l, $w, $h] = $arr;
            $x = $l*$w;
            $y = $w*$h;
            $z = $h*$l;

            $total += (2*$x)+(2*$y)+(2*$z) + $this->findSmallest([$x, $y, $z]);
        }

        return $total;
    }

    private function findSmallest($arr): int {
        return min($arr);
    }

    private function findSmallestTwo($arr): array {
        $firstKey = array_search(min($arr), $arr, false);
        $first = $arr[$firstKey];
        unset($arr[$firstKey]);
        $secondKey = array_search(min($arr), $arr, false);
        $second = $arr[$secondKey];

        return [$first, $second];
    }

    public function partTwo(): int {
        $total = 0;

        foreach($this->input as $row) {
            $arr = explode('x', $row);
            [$s1, $s2] = $this->findSmallestTwo($arr);
            [$l, $w, $h] = $arr;
            $first = $s1 + $s1 + $s2 + $s2;
            $seconds = $l * $w * $h;
            $total += $first + $seconds;
        }
        return $total;
    }
}