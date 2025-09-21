<?php

namespace Thecad\AdventOfCode\Year2022;

use Thecad\AdventOfCode\Base\BaseClass;

class Day02 extends BaseClass
{
    public array $win = [];

    public array $draw = [];

    public array $lose = [];

    public function __construct()
    {
        $this->relativePath = __DIR__;
        parent::__construct();
        $this->win = ['A' => 2, 'B' => 3, 'C' => 1];
        $this->draw = ['A' => 1, 'B' => 2, 'C' => 3];
        $this->lose = ['A' => 3, 'B' => 1, 'C' => 2];
    }

    public function partOne(): int
    {
        $totalPoints = 0;

        foreach ($this->input as $line) {
            $x = explode(' ', $line);
            switch ($x[0]) {
                case 'A':
                    if ($x[1] == 'X') {
                        $totalPoints += (3 + 1);
                    } // Draw
                    if ($x[1] == 'Y') {
                        $totalPoints += (6 + 2);
                    } // Win
                    if ($x[1] == 'Z') {
                        $totalPoints += (0 + 3);
                    } // Lose
                    break;
                case 'B':
                    if ($x[1] == 'X') {
                        $totalPoints += (0 + 1);
                    } // Draw
                    if ($x[1] == 'Y') {
                        $totalPoints += (3 + 2);
                    } // Win
                    if ($x[1] == 'Z') {
                        $totalPoints += (6 + 3);
                    } // Lose
                    break;
                case 'C':
                    if ($x[1] == 'X') {
                        $totalPoints += (6 + 1);
                    } // Draw
                    if ($x[1] == 'Y') {
                        $totalPoints += (0 + 2);
                    } // Win
                    if ($x[1] == 'Z') {
                        $totalPoints += (3 + 3);
                    } // Lose
                    break;
            }
        }

        return $totalPoints;
    }

    public function partTwo(): int
    {
        $totalPoints = 0;
        foreach ($this->input as $line) {
            $x = explode(' ', $line);
            switch ($x[1]) {
                case 'X':
                    $totalPoints += $this->lose[$x[0]];
                    break;
                case 'Y':
                    $totalPoints += $this->draw[$x[0]] + 3;
                    break;
                case 'Z':
                    $totalPoints += $this->win[$x[0]] + 6;
                    break;
            }
        }

        return $totalPoints;
    }
}
