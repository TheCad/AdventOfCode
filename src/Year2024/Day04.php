<?php

namespace Thecad\AdventOfCode\Year2024;

use Thecad\AdventOfCode\Base\BaseClass;

class Day04 extends BaseClass
{
    public function __construct()
    {
        $this->relativePath = __DIR__;
        parent::__construct();
    }

    public function partOne(): int
    {
        $word = 'XMAS';
        $grid = array_map('str_split', $this->input);
        $rows = count($grid);
        $cols = count($grid[0]);
        $wordLength = strlen($word);
        $directions = [
            [0, 1],
            [1, 0],
            [1, 1],
            [1, -1],
            [0, -1],
            [-1, 0],
            [-1, -1],
            [-1, 1],
        ];
        $count = 0;

        foreach ($grid as $rowIndex => $row) {
            foreach ($row as $colIndex => $cell) {
                foreach ($directions as [$dx, $dy]) {
                    $match = true;
                    for ($i = 0; $i < $wordLength; $i++) {
                        $x = $rowIndex + $i * $dx;
                        $y = $colIndex + $i * $dy;

                        if ($x < 0 || $y < 0 || $x >= $rows || $y >= $cols || $grid[$x][$y] !== $word[$i]) {
                            $match = false;
                            break;
                        }
                    }

                    if ($match) {
                        $count++;
                    }
                }
            }
        }

        return $count;
    }

    public function partTwo(): int
    {
        $grid = array_map('str_split', $this->input);
        $rows = count($grid);
        $cols = count($grid[0]);
        $count = 0;

        for ($y = 1; $y < $rows - 1; $y++) {
            for ($x = 1; $x < $cols - 1; $x++) {
                if ($grid[$y][$x] === 'A' && $this->checkNeighbours($grid, $x, $y)) {
                    $count++;
                }
            }
        }

        return $count;
    }

    private function checkNeighbours(array $grid, int $x, int $y): bool
    {
        $diagonals = [
            [[-1, -1], [1, 1]],
            [[-1, 1], [1, -1]],
        ];

        foreach ($diagonals as $offsets) {
            $opposite = null;
            foreach ($offsets as [$dx, $dy]) {
                $newX = $x + $dx;
                $newY = $y + $dy;

                if (! isset($grid[$newY][$newX])) {
                    return false;
                }

                $value = $grid[$newY][$newX];

                if ($value !== 'M' && $value !== 'S') {
                    return false;
                }

                if ($opposite === null) {
                    $opposite = $value;
                } elseif ($value !== ($opposite === 'M' ? 'S' : 'M')) {
                    return false;
                }
            }
        }

        return true;
    }
}
