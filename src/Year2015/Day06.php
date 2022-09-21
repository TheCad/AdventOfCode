<?php

namespace Thecad\AdventOfCode\Year2015;

use Thecad\AdventOfCode\Base\BaseClass;

class Day06 extends BaseClass {
    public function __construct() {
        $this->relativePath = __DIR__;
        parent::__construct();
    }

    // Off = x
    // On = o
    public array $grid = [[]];

    public function partOne(): int {
        $this->fillGrid();

        foreach ($this->input as $row) {
            preg_match_all("/turn on|turn off|toggle|\d*,\d*/", $row, $directions);
            $directions = $directions[0]; // flatten array
            $directions[1] = explode(',', $directions[1]);
            $directions[2] = explode(',', $directions[2]);

            switch ($directions[0]) {
                case "toggle":
                    $this->toggle($directions[1], $directions[2]);
                    break;
                case "turn on":
                    $this->turnOn($directions[1], $directions[2]);
                    break;
                case "turn off":
                    $this->turnOff($directions[1], $directions[2]);
                    break;
                default:
                    break;
            }
        }
        return $this->checkHowMuchOn();
    }

    public function partTwo(): int {
        // Create solution

        return 0;
    }

    private function toggle(array $start, array $end): void {

        for ($i = $start[0]; $i <= $end[0]; $i++) {
            for ($j = $start[1]; $j <= $end[1]; $j++) {
                if ($this->grid[$i][$j] === 'o') {
                    $this->grid[$i][$j] = 'x';
                } else {
                    $this->grid[$i][$j] = 'o';
                }
            }
        }
    }

    private function turnOn(array $start, array $end): void {
        for ($i = $start[0]; $i <= $end[0]; $i++) {
            for ($j = $start[1]; $j <= $end[1]; $j++) {
                $this->grid[$i][$j] = 'o';
            }
        }
    }

    private function turnOff(array $start, array $end): void {
        for ($i = $start[0]; $i <= $end[0]; $i++) {
            for ($j = $start[1]; $j <= $end[1]; $j++) {
                $this->grid[$i][$j] = 'x';
            }
        }
    }

    private function checkHowMuchOn(): int {
        $total = 0;
        foreach ($this->grid as $row) {
            foreach ($row as $line) {
                if ($line === 'o') {
                    $total++;
                }
            }
        }
        return $total;
    }

    private function fillGrid(): void {
        for ($i = 0; $i < 1000; $i++) {
            for ($j = 0; $j < 1000; $j++) {
                $this->grid[$i][$j] = 'x';
            }
        }
    }

}