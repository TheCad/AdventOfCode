<?php

namespace Thecad\AdventOfCode\Year2025;

use Thecad\AdventOfCode\Base\BaseClass;

class Day01 extends BaseClass
{
    public function __construct()
    {
        $this->relativePath = __DIR__;
        parent::__construct();
    }

    public function partOne(): int
    {
        $number = 50;
        $total = 0;
        foreach ($this->input as $line) {
            $direction = $line[0];
            $amount = intval(substr($line, 1));
            switch ($direction) {
                case 'L':
                    $number = ($number - $amount % 100 + 100) % 100;
                    break;
                case 'R':
                    $number = ($number + $amount) % 100;
            }
            if ($number === 0) {
                $total++;
            }
        }

        return $total;
    }

    public function partTwo(): int
    {
        $number = 50;
        $total = 0;

        foreach ($this->input as $line) {
            $direction = $line[0];
            $amount = intval(substr($line, 1));
            $oldNumber = $number;

            switch ($direction) {
                case 'L':
                    $flippedNumber = (100 - $oldNumber) % 100;
                    $total += intdiv($flippedNumber + $amount, 100);
                    $number = (($number - $amount) % 100 + 100) % 100;
                    break;
                case 'R':
                    $total += intdiv($oldNumber + $amount, 100);
                    $number = ($number + $amount) % 100;
                    break;
            }
        }

        return $total;
    }
}
