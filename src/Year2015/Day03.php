<?php

namespace Thecad\AdventOfCode\Year2015;

use Thecad\AdventOfCode\Base\BaseClass;

class Day03 extends BaseClass {
    public function __construct() {
        $this->relativePath = __DIR__;
        parent::__construct();
    }

    public function partOne(): int {
        $visited = array();
        $x = $y = 0;
        $visited["0.0"] = 1;
        foreach($this->input as $row) {
            $arr = str_split($row);
            foreach ($arr as $step) {
                switch ($step) {
                    case '>':
                        $x++;
                        break;
                    case '<':
                        $x--;
                        break;
                    case '^':
                        $y++;
                        break;
                    case 'v':
                    case 'V':
                        $y--;
                        break;

                    default:
                        break;
                }
                $visited["$x.$y"] = 1;
            }
        }

        $res = array_count_values($visited);
        return $res[1];
    }

    public function partTwo(): void {
        // Create solution
    }
}