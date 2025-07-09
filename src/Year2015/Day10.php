<?php

namespace Thecad\AdventOfCode\Year2015;

use Thecad\AdventOfCode\Base\BaseClass;

class Day10 extends BaseClass
{
    public function __construct()
    {
        $this->relativePath = __DIR__;
        parent::__construct();
    }

    public function partOne(): string
    {
        $string = $this->input[0];
        $loopAmount = 40;
        return $this->lookAndSay($loopAmount, $string);
    }

    public function partTwo(): int
    {
        $string = $this->input[0];
        $loopAmount = 50;
        return $this->lookAndSay($loopAmount, $string);
    }

    public function lookAndSay(int $loopAmount, string $string): string
    {
        $endStr = '';
        for ($iteration = 0; $iteration < $loopAmount; $iteration++) {
            if (strlen($string) === 1) {
                return '1' . $string;
            }

            $endStr = '';
            $count = 1;

            for ($i = 0; $i < strlen($string); $i++) {
                if (isset($string[$i + 1]) && $string[$i] === $string[$i + 1]) {
                    $count++;
                } else {
                    $endStr .= $count . $string[$i];
                    $count = 1;
                }
            }
            $string = $endStr;
        }
        return strlen($string);
    }
}

