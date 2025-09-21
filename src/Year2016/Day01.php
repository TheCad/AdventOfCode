<?php

namespace Thecad\AdventOfCode\Year2016;

use Thecad\AdventOfCode\Base\BaseClass;

enum Direction
{
    case North;
    case East;
    case South;
    case West;
}

class Day01 extends BaseClass
{
    public function __construct()
    {
        $this->relativePath = __DIR__;
        parent::__construct();
    }

    public Direction $direction = Direction::North;

    public int $x = 0;

    public int $y = 0;

    public function partOne(): int
    {
        // Create solution

        $input = explode(',', $this->input[0]);
        foreach ($input as $item) {
            $turnDir = strtolower(trim($item)[0]);
            $stepAmount = (int) substr(trim($item), 1);
            $this->changeDirection($turnDir);
            switch ($this->direction) {
                case Direction::North:
                    $this->y += $stepAmount;
                    break;
                case Direction::East:
                    $this->x += $stepAmount;
                    break;
                case Direction::South:
                    $this->y -= $stepAmount;
                    break;
                case Direction::West:
                    $this->x -= $stepAmount;
                    break;
            }
        }
        $result = abs($this->x) + abs($this->y);

        return $result;
    }

    public function partTwo(): int
    {
        // Create solution
        $this->resetGlobs();
        $alreadyVisited = [[]];
        $alreadyVisited[0][0] = 'x';
        $input = explode(',', $this->input[0]);
        foreach ($input as $item) {
            $turnDir = strtolower(trim($item)[0]);
            $stepAmount = (int) substr(trim($item), 1);
            $this->changeDirection($turnDir);

            for ($i = 0; $i < $stepAmount; $i++) {
                switch ($this->direction) {
                    case Direction::North:
                        $this->y++;
                        break;
                    case Direction::East:
                        $this->x++;
                        break;
                    case Direction::South:
                        $this->y--;
                        break;
                    case Direction::West:
                        $this->x--;
                        break;
                }
                if (array_key_exists($this->x, $alreadyVisited) && array_key_exists($this->y, $alreadyVisited[$this->x])) {
                    return abs($this->x) + abs($this->y);
                }
                $alreadyVisited[$this->x][$this->y] = 'x';
            }
        }
        $result = abs($this->x) + abs($this->y);

        return $result;
    }

    private function changeDirection(string $turnDir)
    {
        switch ($this->direction) {
            case Direction::North:
                if ($turnDir === 'r') {
                    $this->direction = Direction::East;
                } else {
                    $this->direction = Direction::West;
                }
                break;
            case Direction::East:
                if ($turnDir === 'r') {
                    $this->direction = Direction::South;
                } else {
                    $this->direction = Direction::North;
                }
                break;
            case Direction::South:
                if ($turnDir === 'r') {
                    $this->direction = Direction::West;
                } else {
                    $this->direction = Direction::East;
                }
                break;
            case Direction::West:
                if ($turnDir === 'r') {
                    $this->direction = Direction::North;
                } else {
                    $this->direction = Direction::South;
                }
                break;
        }
    }

    private function resetGlobs(): void
    {
        $this->direction = Direction::North;
        $this->x = 0;
        $this->y = 0;
    }
}
