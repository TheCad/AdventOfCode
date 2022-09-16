<?php

namespace Thecad\AdventOfCode\Year2015;

use Thecad\AdventOfCode\Base\BaseClass;

class Day05 extends BaseClass {
    public array $vowels = ['a', 'e', 'i', 'o', 'u'];
    public array $illegal = [
        'ab',
        'cd',
        'pq',
        'xy'
        ];

    public function __construct() {
        $this->relativePath = __DIR__;
        parent::__construct();
    }

    public function partOne(): int {
        $total = ['nice' => 0, 'naughty' => 0];
        foreach($this->input as $row) {
            if ($this->checkForIllegal($row)) {
                $total['naughty']++;
//                dump("$row contains illegal string");
                continue;
            }

            if ($this->vowelCount($row) < 3) {
                $total['naughty']++;
//                dump("$row has a vowel count < 3");
                continue;
            }

            if (!$this->checkLetterInRow($row)) {
                $total['naughty']++;
//                dump("$row does not have 2 same letters in a row");
                continue;
            }
            $total['nice']++;

        }
        return $total['nice'];
    }

    public function partTwo(): int {
        // Create solution

        return 0;
    }

    private function vowelCount(string $row): int {
        preg_match_all('/[aeuio]/i', $row, $matches);
        return count($matches[0]);
    }

    private function checkLetterInRow(string $row): bool {
        $arr = str_split($row);
        $count = count($arr);
        for ($i = 0; $i < $count - 1 ; $i++) {
            if ($arr[$i] === $arr[$i+1]) {
                return true;
            }
        }
        return false;
    }

    private function checkForIllegal(string $row): bool {
        foreach ($this->illegal as $item) {
            if (str_contains($row, $item)) {
                return true;
            }
        }

        return false;
    }
}