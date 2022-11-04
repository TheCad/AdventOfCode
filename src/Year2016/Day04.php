<?php

namespace Thecad\AdventOfCode\Year2016;

use Thecad\AdventOfCode\Base\BaseClass;

class Day04 extends BaseClass {
    public function __construct() {
        $this->relativePath = __DIR__;
        parent::__construct();
    }

    public function partOne(): int {
        $total = 0;
        foreach ($this->input as $line) {
            $found = true;
            $x = explode('[', $line);

            $name = explode('-',$x[0]);
            $checksum = rtrim($x[1], "]");
            $id = array_pop($name);
            $string = implode('', $name);
            $count = array_count_values(str_split($string));
            arsort($count);

            $five = array_slice($count, 0, 5);

            for ($i = 0; $i < strlen($checksum); $i++) {
                if (!array_key_exists($checksum[$i], $five)) {
                    dump($checksum, $five);
                    $found = false;
                    break;
                }
            }
            if ($found) {
                dump("Adding $id to total");
                $total += $id;
            }
        }
        return $total;
    }

    public function partTwo(): int {
        // Create solution

        return 0;
    }
}