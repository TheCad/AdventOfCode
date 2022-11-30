<?php

namespace Thecad\AdventOfCode\Year2020;

use Thecad\AdventOfCode\Base\BaseClass;

class Day02 extends BaseClass {
    public function __construct() {
        $this->relativePath = __DIR__;
        parent::__construct();
    }

    public function partOne(): int {
        $count = 0;
        foreach ($this->input as $line) {
            $split = explode(":", $line);
            $minmax = explode("-", explode(" ", $split[0])[0]);
            $critLetter = explode(" ", $split[0])[1];

            $passAmount = array_count_values(str_split(trim($split[1])));

            if ($passAmount[$critLetter] >= $minmax[0] && $passAmount[$critLetter] <= $minmax[1]) {
                $count++;
            }
        }
        return $count;
    }

    public function partTwo(): int {
        $count = 0;
        foreach ($this->input as $line) {
            $split = explode(":", $line);
            $minmax = explode("-", explode(" ", $split[0])[0]);
            $critLetter = explode(" ", $split[0])[1];
            $workablePass = str_split(trim($split[1]));

            if ($workablePass[$minmax[0] - 1] == $critLetter || $workablePass[$minmax[1] - 1] == $critLetter) {
                if ($workablePass[$minmax[0] - 1] == $critLetter && $workablePass[$minmax[1] - 1] == $critLetter)
                    continue;
                $count++;
            }
        }
        return $count;

        return 0;
    }
}