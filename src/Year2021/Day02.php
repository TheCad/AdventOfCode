<?php

namespace Thecad\AdventOfCode\Year2021;

use Thecad\AdventOfCode\Base\BaseClass;

class Day02 extends BaseClass
{
    public function __construct()
    {
        $this->relativePath = __DIR__;
        parent::__construct();
    }

    public function partOne(): int
    {
        $horizontal = 0;
        $depth = 0;
        foreach ($this->input as $step) {
            $direction = explode(' ', $step)[0];
            $amount = (int) explode(' ', $step)[1];
            switch ($direction) {
                case 'forward':
                    $horizontal += $amount;
                    break;
                case 'down':
                    $depth += $amount;
                    break;
                case 'up':
                    $depth -= $amount;
                    break;
            }
        }

        return $horizontal * $depth;
    }

    public function partTwo(): int
    {
        $horizontal = 0;
        $depth = 0;
        $aim = 0;
        foreach ($this->input as $step) {
            $direction = explode(' ', $step)[0];
            $amount = (int) explode(' ', $step)[1];
            switch ($direction) {
                case 'forward':
                    $horizontal += $amount;
                    $depth += ($aim * $amount);
                    break;
                case 'down':
                    $aim += $amount;
                    break;
                case 'up':
                    $aim -= $amount;
                    break;
            }
        }

        return $horizontal * $depth;
    }
}
