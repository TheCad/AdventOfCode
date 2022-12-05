<?php

namespace Thecad\AdventOfCode\Year2022;

use Thecad\AdventOfCode\Base\BaseClass;

class Day05 extends BaseClass {
    public array $stack = [ ];

    public function __construct() {
        $this->relativePath = __DIR__;
        parent::__construct();
        $this->input = array_slice($this->input, 10);
    }

    public function setStack(array $stack) {
        $this->stack = $stack;
    }

    public function partOne(): string {
        $this->resetStack();
        foreach($this->input as $line) {
            $x = explode(' ', $line);
            $amount = $x[1];
            $from = $x[3]-1;
            $to = $x[5]-1;

            for ($i = 0; $i < $amount; $i++) {
                $temp = array_shift($this->stack[$from]);
                array_unshift($this->stack[$to], $temp);
            }
        }

        $word = '';
        foreach($this->stack as $row) {
            $word .= $row[0];
        }
        return $word;
    }

    public function partTwo(): string {
        $this->resetStack();
        foreach($this->input as $line) {
            $x = explode(' ', $line);
            $amount = $x[1];
            $from = $x[3]-1;
            $to = $x[5]-1;

            $o = [];
            for ($i = 0; $i < $amount; $i++) {
                $temp = array_shift($this->stack[$from]);
                $o[] = $temp;
            }
            $o = array_reverse($o);
            foreach ($o as $y) {
                array_unshift($this->stack[$to], $y);
            }
        }

        $word = '';
        foreach($this->stack as $row) {
            $word .= $row[0];
        }
        return $word;

        return 0;
    }

    private function resetStack() {
        $this->stack = [
            ["G", "J", "W", "R", "F", "T", "Z"],
            ["M", "W", "G"],
            ["G", "H", "N", "J"],
            ["W", "N", "C", "R", "J"],
            ["M", "V", "Q", "G", "B", "S", "F", "W"],
            ["C", "W", "V", "D", "T", "R", "S"],
            ["V", "G", "Z", "D", "C", "N", "B", "H"],
            ["C", "G", "M", "N", "J", "S"],
            ["L", "D", "J", "C", "W", "N", "P", "G"]
        ];
    }
}
