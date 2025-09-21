<?php

namespace Thecad\AdventOfCode\Year2015;

use Thecad\AdventOfCode\Base\BaseClass;

class Day05 extends BaseClass
{
    public array $vowels = ['a', 'e', 'i', 'o', 'u'];

    public array $illegal = [
        'ab',
        'cd',
        'pq',
        'xy',
    ];

    public function __construct()
    {
        $this->relativePath = __DIR__;
        parent::__construct();
    }

    public function partOne(): int
    {
        $total = ['nice' => 0, 'naughty' => 0];
        foreach ($this->input as $row) {
            if ($this->checkForIllegal($row)) {
                $total['naughty']++;

                continue;
            }

            if ($this->vowelCount($row) < 3) {
                $total['naughty']++;

                continue;
            }

            if (! $this->checkLetterInRow($row)) {
                $total['naughty']++;

                continue;
            }
            $total['nice']++;

        }

        return $total['nice'];
    }

    public function partTwo(): int
    {
        //        echo count(array_filter(file('src/Year2015/inputs/Day05_input.txt'), function ($x) {return preg_match('#(?=.*(..).*\1)(?=.*(.).\2)#',$x);}));
        $o = array_filter(file('src/Year2015/inputs/Day05_input.txt'), function ($x) {
            return preg_match('#(?=.*(..).*\1)(?=.*(.).\2)#', $x);
        });
        $p = [];

        $total = ['nice' => 0, 'naughty' => 0];
        foreach ($this->input as $row) {
            if (! $this->checkDoubleLetters($row)) {
                $total['naughty']++;

                continue;
            }

            if (! $this->checkInBetween($row)) {
                $total['naughty']++;

                continue;
            }
            $p[] = $row;
            $total['nice']++;
        }

        //        dd($o, $p);
        return $total['nice'];
    }

    private function checkDoubleLetters(string $row): bool
    {
        $c = strlen($row);
        for ($i = 0; $i < $c - 1; $i++) {
            $y = substr($row, $i, 2);
            $x = substr_replace($row, '!!', $i, 2);
            if (str_contains($x, $y)) {
                return true;
            }
        }

        return false;
    }

    private function checkInBetween(string $row): bool
    {
        $arr = str_split($row);
        $count = count($arr);
        for ($i = 0; $i < $count - 2; $i++) {
            if ($arr[$i] === $arr[$i + 2]) {
                return true;
            }
        }

        return false;
    }

    private function vowelCount(string $row): int
    {
        preg_match_all('/[aeuio]/i', $row, $matches);

        return count($matches[0]);
    }

    private function checkLetterInRow(string $row): bool
    {
        $arr = str_split($row);
        $count = count($arr);
        for ($i = 0; $i < $count - 1; $i++) {
            if ($arr[$i] === $arr[$i + 1]) {
                return true;
            }
        }

        return false;
    }

    private function checkForIllegal(string $row): bool
    {
        foreach ($this->illegal as $item) {
            if (str_contains($row, $item)) {
                return true;
            }
        }

        return false;
    }
}
