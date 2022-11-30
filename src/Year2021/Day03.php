<?php

namespace Thecad\AdventOfCode\Year2021;

use Thecad\AdventOfCode\Base\BaseClass;

class Day03 extends BaseClass {
    public int $oxIndex = 0;
    public int $coIndex = 0;

    public function __construct() {
        $this->relativePath = __DIR__;
        parent::__construct();
    }

    public function partOne(): int {
        $strlen = strlen($this->input[0]);
        $amount = array_fill(0, $strlen, array_fill(0,2,null));
        $gamma = "";
        $epsilon ="";

        foreach ($this->input as $line) {
            for($i = 0; $i < $strlen; $i++) {
                switch ($line[$i]) {
                    case 0:
                        $amount[$i][0]++;
                        break;
                    case 1:
                        $amount[$i][1]++;
                        break;
                }
            }
        }


        foreach ($amount as $line) {
            if ($line[0] > $line[1]) {
                $gamma .= "0";
                $epsilon .= "1";
            }
            else {
                $gamma .= "1";
                $epsilon .= "0";
            }
        }

        return (bindec($gamma) * bindec($epsilon));
    }

    public function partTwo(): int {
        $ox = $this->getOxygen($this->input);
        $co = $this->getCo2($this->input);

        return (bindec($ox) * bindec($co));
    }

    function getOxygen($list) {
        if (count($list) == 1 )
            return $list[0];
        return $this->getOxygen($this->getHighest($list));
    }

    private function getCo2($list)
    {
        if (count($list) == 1)
            return $list[0];
        return $this->getCo2($this->getLowest($list));
    }

    function getHighest($list) {
        $result = $this->countZeroesAndOnes($list, $this->oxIndex);
        $this->oxIndex++;

        return (count($result['zeroes']) > count($result['ones']) ? $result['zeroes'] : $result['ones']);
    }

    function getLowest($list) {
        $result = $this->countZeroesAndOnes($list, $this->coIndex);
        $this->coIndex++;

        return (count($result['zeroes']) > count($result['ones']) ? $result['ones'] : $result['zeroes']);
    }

    function countZeroesAndOnes($list, $index): array {
        $zeroes = [];
        $ones = [];
        $count = array_fill(0, 2, null);
        foreach ($list as $item) {
            switch ($item[$index]) {
                case 0:
                    $count[0]++;
                    $zeroes[] = $item;
                    break;
                case 1:
                    $count[1]++;
                    $ones[] = $item;
                    break;
            }
        }

        $result['zeroes'] = $zeroes;
        $result['ones'] = $ones;

        return $result;
    }
}