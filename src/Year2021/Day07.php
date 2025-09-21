<?php

namespace Thecad\AdventOfCode\Year2021;

use Thecad\AdventOfCode\Base\BaseClass;

class Day07 extends BaseClass
{
    public function __construct()
    {
        $this->relativePath = __DIR__;
        parent::__construct();
        $this->input = explode(',', $this->input[0]);
    }

    public function partOne(): int
    {
        $amount = PHP_INT_MAX;
        $list = array_count_values($this->input);
        arsort($list);
        foreach ($list as $item => $value) {
            $fuel = $this->getAmountOfFuel($item);
            $amount = (array_sum($fuel) < $amount) ? array_sum($fuel) : $amount;
        }

        return $amount;
    }

    public function partTwo(): int
    {
        $amount = PHP_INT_MAX;
        $res = [];

        foreach (range(0, max($this->input), 1) as $item => $value) {
            $fuel = array_sum($this->getAmountOfFuelIncremental($item));
            $res[] = $fuel;
        }
        sort($res);

        return $res[0];
    }

    public function getAmountOfFuel($horpos)
    {
        $temp = [];
        foreach ($this->input as $item) {
            $fuelcost = (int) $horpos - (int) $item;
            if ($fuelcost < 0) {
                $fuelcost = -$fuelcost;
            }
            $temp[] = $fuelcost;
        }

        return $temp;
    }

    public function getAmountOfFuelIncremental($horpos)
    {
        $temp = [];

        foreach ($this->input as $item) {
            $fuelcost = abs($horpos - (int) $item);
            if ($fuelcost < 0) {
                $fuelcost = -$fuelcost;
            }
            $temp[] = array_sum(range(0, $fuelcost, 1));
        }
        $res = array_sum($temp);

        return $temp;
    }
}
