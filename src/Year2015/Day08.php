<?php

namespace Thecad\AdventOfCode\Year2015;

use Thecad\AdventOfCode\Base\BaseClass;

class Day08 extends BaseClass {
    public function __construct() {
        $this->relativePath = __DIR__;
        parent::__construct();
    }

    public function partOne(): int {
        foreach ($this->input as $line) {
            $line = 'abc\\uwu\\Bla';
            $this->checkAndReplaceForDoubleBackslash($line);

            $line = '"qwe\"owo\"wejoo\""';
            $this->checkAndReplaceForLoneDoubleQoute($line);

            die();
        }

        return 0;
    }

    public function partTwo(): int {
        // Create solution

        return 0;
    }

    private function checkAndReplaceForDoubleBackslash(string $input) {
        $x = str_replace('\\\\', '\\', $input);
        dump($x);
    }

    private function checkAndReplaceForLoneDoubleQoute(string $input) {
        $x = str_replace('\"', '"', $input);
        dump($x);
    }

    private function checkAndReplaceForHexDex(string $input) {
        $x = preg_replace('/\\[0-9a-f]{2}\'
    }
}
