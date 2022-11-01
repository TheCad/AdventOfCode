<?php

namespace Thecad\AdventOfCode\Year2016;

use Thecad\AdventOfCode\Base\BaseClass;

class Day02 extends BaseClass {

    public array $keypad = array(array());

    public function __construct() {
        $this->relativePath = __DIR__;
        parent::__construct();
    }

    public function partOne(): int {
        $keypad = array(array());
        $keypad[0][0] = 1; $keypad[0][1] = 2; $keypad[0][2] = 3;
        $keypad[1][0] = 4; $keypad[1][1] = 5; $keypad[1][2] = 6;
        $keypad[2][0] = 7; $keypad[2][1] = 8; $keypad[2][2] = 9;
        $number = '';
        foreach ($this->input as $line) {
            $x = 1;
            $y = 1;
            $split = str_split($line);
            foreach ($split as $step) {
                switch ($step) {
                    case 'U':
                        if ($x != 0) $x--;
                        break;
                    case 'R':
                        if ($y != 2) $y++;
                        break;
                    case 'D':
                        if ($x != 2) $x++;
                        break;
                    case 'L':
                        if ($y != 0) $y--;
                        break;
                }
            }
            $number .= $keypad[$x][$y];
        }


        return (int)$number;
    }

    public function partTwo(): string {
        // Create solution
        $keypad = array(array());

        $number = '';

        $keypad[0][0] = null;   $keypad[0][1] = null;   $keypad[0][2] = 1;      $keypad[0][3] = null;   $keypad[0][4] = null;
        $keypad[1][0] = null;   $keypad[1][1] = 2;      $keypad[1][2] = 3;      $keypad[1][3] = 4;      $keypad[1][4] = null;
        $keypad[2][0] = 5;      $keypad[2][1] = 6;      $keypad[2][2] = 7;      $keypad[2][3] = 8;      $keypad[2][4] = 9;
        $keypad[3][0] = null;   $keypad[3][1] = 'A';    $keypad[3][2] = 'B';    $keypad[3][3] = 'C';    $keypad[3][4] = null;
        $keypad[4][0] = null;   $keypad[4][1] = null;   $keypad[4][2] = 'D';    $keypad[4][3] = null;   $keypad[4][4] = null;

        foreach ($this->input as $line) {
            $split = str_split($line);
            $x = 1;
            $y = 1;
            foreach ($split as $step) {
                switch ($step) {
                    case 'U':
                        if ($x != 0 && $keypad[$x-1][$y] !== null) $x--;
                        break;
                    case 'R':
                        if ($y != 4 &&$keypad[$x][$y+1] !== null) $y++;
                        break;
                    case 'D':
                        if ($x != 4 && $keypad[$x+1][$y] !== null) $x++;
                        break;
                    case 'L':
                        if ($y != 0 &&$keypad[$x][$y-1] !== null) $y--;
                        break;
                }
            }
            $number .= $keypad[$x][$y];
        }
        return $number;
    }
}