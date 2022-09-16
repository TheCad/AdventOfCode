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

    public function partTwo(): int {
        $santa = new Stepper();
        $robo = new Stepper();
        $santa->visisted["0.0"] = 1;
        $robo->visisted["0.0"] = 1;
        $x = 0;

        foreach ($this->input as $row) {
            $arr = str_split($row);
            foreach ($arr as $step) {
                if ($x === 0) {
                    $santa->step($step);
                    $x = 1;
                } else {
                    $robo->step($step);
                    $x = 0;
                }
            }
        }
        $total = array_unique(array_merge(array_keys($santa->visisted), array_keys($robo->visisted)));
        return count($total);
    }
}

class Stepper {
    public int $x = 0, $y = 0;
    public array $visisted = [];

    public function step(string $direction) {
        switch ($direction) {
            case '>':
                $this->x++;
                break;
            case '<':
                $this->x--;
                break;
            case '^':
                $this->y++;
                break;
            case 'v':
            case 'V':
                $this->y--;
                break;
            default:
                break;
        }
        $this->visisted["$this->x.$this->y"] = 1;
    }
}