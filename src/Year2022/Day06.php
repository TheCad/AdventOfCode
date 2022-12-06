<?php

namespace Thecad\AdventOfCode\Year2022;

use Thecad\AdventOfCode\Base\BaseClass;

class Day06 extends BaseClass {
    public function __construct() {
        $this->relativePath = __DIR__;
        parent::__construct();
    }

    public function partOne(): int {
        foreach ($this->input as $line) {
            $num = 1;
            for ($i = 0; $i < strlen($line); $i++) {
                $x = str_split(substr($line, $i, 4));
                $y = array_unique($x);
                if (count($y) == 4)
                    return $num+3;
                $num++;
            }
        }

        return 0;
    }

    public function partTwo(): int {
        foreach ($this->input as $line) {
            $num = 1;
            for ($i = 0; $i < strlen($line); $i++) {
                $x = str_split(substr($line, $i, 14));
                $y = array_unique($x);
                if (count($y) == 14)
                    return $num+13;
                $num++;
            }
        }

        return 0;
    }
}
