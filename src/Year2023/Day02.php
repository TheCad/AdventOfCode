<?php

namespace Thecad\AdventOfCode\Year2023;

use Thecad\AdventOfCode\Base\BaseClass;

class Day02 extends BaseClass {
    private int $maxRed = 12;
    private int $maxGreen = 13;
    private int $maxBlue = 14;

    public function __construct() {
        $this->relativePath = __DIR__;
        parent::__construct();
    }

    public function partOne(): int {
        $total = 0;
        foreach ($this->input as $item) {
            $x = explode(':', $item);
            $x2 = explode(' ', $x[0]);
            $id = intval($x2[1]);
            $lines = explode(';', $x[1]);
            $redYes = $greenYes = $blueYes = true;
            foreach ($lines as $line) {
                $sep = explode(',', $line);
                $cleanSep = array_map('trim', $sep);
                foreach ($cleanSep as $stuff) {
                    $bliep = explode(' ', $stuff);
                    switch ($bliep[1]) {
                        case 'green':
                            if ($bliep[0] > $this->maxGreen) {
                                $greenYes = false;
                            }
                            break;
                        case 'red':
                            if ($bliep[0] > $this->maxRed) {
                                $redYes = false;
                            }
                            break;
                        case 'blue':
                            if ($bliep[0] > $this->maxBlue) {
                                $blueYes = false;
                            }
                            break;
                    }
                }
            }
            if ($redYes && $blueYes && $greenYes)
                $total += $id;
        }
        return $total;
    }

    public function partTwo(): int {
        $total = 0;
        foreach ($this->input as $item) {
            $highestGreen = 0;
            $highestBlue = 0;
            $highestRed = 0;
            $sets = explode(':', $item)[1];
            $exSets = array_map('trim',explode(';', $sets));
            foreach ($exSets as $set) {
                $split = array_map('trim', explode(',', $set));
                foreach ($split as $row) {
                    $exSplit = explode(' ', $row);
                    switch ($exSplit[1]) {
                        case 'green':
                            if ($exSplit[0] > $highestGreen)
                                $highestGreen = $exSplit[0];
                            break;
                        case 'blue':
                            if ($exSplit[0] > $highestBlue)
                                $highestBlue = $exSplit[0];
                            break;
                        case 'red':
                            if ($exSplit[0] > $highestRed)
                                $highestRed = $exSplit[0];
                            break;
                    }
                }
            }
            $total += ($highestGreen * $highestRed * $highestBlue);
        }
        return $total;
    }
}