<?php

namespace Thecad\AdventOfCode\Year2022;

use Thecad\AdventOfCode\Base\BaseClass;

class Day04 extends BaseClass
{
    public function __construct()
    {
        $this->relativePath = __DIR__;
        parent::__construct();
    }

    public function partOne(): int
    {
        $total = 0;
        foreach ($this->input as $line) {
            [$first, $second] = explode(',', $line);
            [$firstFirst, $firstSecond] = explode('-', $first);
            [$secondFirst, $secondSecond] = explode('-', $second);
            if (($firstFirst <= $secondFirst && $firstSecond >= $secondSecond) || ($secondFirst <= $firstFirst && $secondSecond >= $firstSecond)) {
                $total++;
            }
        }

        return $total;
    }

    public function partTwo(): int
    {
        $total = 0;
        foreach ($this->input as $line) {
            [$first, $second] = explode(',', $line);
            [$firstFirst, $firstSecond] = explode('-', $first);
            [$secondFirst, $secondSecond] = explode('-', $second);

            $x = range($firstFirst, $firstSecond);
            $y = range($secondFirst, $secondSecond);

            if (! empty(array_intersect($x, $y))) {
                $total++;
            }

        }

        return $total;
    }
}
