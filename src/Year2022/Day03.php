<?php

namespace Thecad\AdventOfCode\Year2022;

use Thecad\AdventOfCode\Base\BaseClass;

class Day03 extends BaseClass
{
    public string $prio = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    public function __construct()
    {
        $this->relativePath = __DIR__;
        parent::__construct();
    }

    public function partOne(): int
    {
        $total = 0;
        foreach ($this->input as $line) {
            [$first, $second] = str_split($line, strlen($line) / 2);
            $first = array_unique(str_split($first));
            $second = array_unique(str_split($second));

            $overlap = array_values(array_intersect($first, $second));

            $total += strpos($this->prio, $overlap[0]) + 1;
        }

        return $total;
    }

    public function partTwo(): int
    {
        $total = 0;
        for ($i = 0; $i < count($this->input); $i += 3) {
            $x = array_unique(str_split($this->input[$i]));
            $y = array_unique(str_split($this->input[$i + 1]));
            $z = array_unique(str_split($this->input[$i + 2]));

            $overlap = array_values(array_intersect($x, $y, $z));
            $total += strpos($this->prio, $overlap[0]) + 1;
        }

        return $total;
    }
}
