<?php

namespace Thecad\AdventOfCode\Year2016;

use Thecad\AdventOfCode\Base\BaseClass;

class Day03 extends BaseClass {
    public function __construct() {
        $this->relativePath = __DIR__;
        parent::__construct();
    }

    public function partOne(): int {
        $amount = 0;
        foreach ($this->input as $line) {
            $triangles = array_values(array_filter(explode(' ', $line)));
            if ($triangles[0] + $triangles[1] > $triangles[2]
            &&  $triangles[1] + $triangles[2] > $triangles[0]
            &&  $triangles[2] + $triangles[0] > $triangles[1]) {
                $amount++;
            }
        }

        return $amount;
    }

    public function partTwo(): int {
        $array = [];
        $amount = 0;
        foreach ($this->input as $line) {
            $array[] = array_values(array_filter(explode(' ', $line)));
        }
        for ($i = 0; $i < count($array); $i += 3) {
            for ($y = 0; $y < count($array[$y]); $y++) {
                if ($array[$i][$y] + $array[$i+1][$y] > $array[$i+2][$y]
                    &&  $array[$i+1][$y] + $array[$i+2][$y] > $array[$i][$y]
                    &&  $array[$i+2][$y] + $array[$i][$y] > $array[$i+1][$y]) {
                    $amount++;
                }
            }
        }
        return $amount;
    }
}