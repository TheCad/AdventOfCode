<?php

namespace Thecad\AdventOfCode\Year2021;

use Thecad\AdventOfCode\Base\BaseClass;

class Day06 extends BaseClass
{
    private $data = array();
    public function __construct()
    {
        $this->relativePath = __DIR__;
        parent::__construct();
        $this->loadData();
    }

    public function loadData() {
        $handle = fopen(__DIR__. '/inputs/Day06_input.txt', 'r');
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                $this->data = explode(',',$line);
            }

            fclose($handle);
        } else {
            echo "Can't find file";
        }
    }

    public function partOne(): int
    {
        return $this->doSteps(18);
    }

    public function partTwo(): int
    {
        return $this->doSteps(256);
    }

    private function doSteps($count) {
        $temp = new \Ds\Deque(array_fill(0, 9, 0));

        foreach ($this->data as $value) {
            $temp[(int)$value] += 1;
        }

        foreach (range(0, $count-1) as $item) {
            $temp->rotate(1);
            $temp[6] += $temp[8];
        }
        return $temp->sum();
    }
}