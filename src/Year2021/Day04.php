<?php

namespace Thecad\AdventOfCode\Year2021;

use Thecad\AdventOfCode\Base\BaseClass;

class Day04 extends BaseClass {
    public array $bingo = array();
    public array $numbers = array();

    public array $bingoCards;

    public function __construct() {
        $this->relativePath = __DIR__;
        parent::__construct();
        $bingohandle = fopen(__DIR__ . '/inputs/Day04_Bingo_input.txt', 'r');
        $numberhandle = fopen(__DIR__. '/inputs/Day04_Number_Input.txt', 'r');
        if ($bingohandle && $numberhandle) {
            while (($line = fgets($bingohandle)) !== false) {
                $this->bingo[] = trim(str_replace("  ", " ", $line));
            }
            while(($line = fgets($numberhandle)) !== false) {
                $this->numbers = explode(',', $line);
            }

            fclose($bingohandle);
        } else {
            echo "Can't find file";
        }
        $this->readInput();
    }

    public function partOne(): int
    {
        foreach ($this->numbers as $number) {
            /** @var bingoCard $bingoCard */
            foreach ($this->bingoCards as $bingoCard) {
                $bingoCard->scratchNumberOnCard($number);
                $result = $bingoCard->checkForBingo();
                if ($result) {
                    $sum = 0;
                    foreach ($result as $item) {
                        $sum += $item->getNumber();
                    }

                    return $sum * $number;
                }
            }
        }
        return 0;
    }

    public function partTwo(): int {
        foreach($this->numbers as $number) {
            /** @var bingoCard $bingoCard */
            foreach ($this->bingoCards as $bingoCard) {
                $bingoCard->scratchNumberOnCard($number);
                $bingoCard->checkForBingo();
                if ($this->getAmountOfBingo()) {
                    $sum = 0;
                    foreach ($bingoCard->checkForBingo() as $item) {
                        $sum += $item->getNumber();
                    }
                    return $sum * $number;
                }
            }
        }
        return 0;
    }

    private function getAmountOfBingo() {
        $notWon =[];
        foreach ($this->bingoCards as $bingoCard) {
            if (!$bingoCard->hasWon()) {
                $notWon[] = $bingoCard;
            }
        }
        return count($notWon) === 0;
    }

    private function readInput() {
        $temp = array();
        $index = 0;
        $bingoId = 0;
        foreach ($this->bingo as $line) {
            if (empty($line)) {
                $bingoCard = new BingoCard((int)$bingoId);
                $bingoCard->setRowNumbers($temp[0], $temp[1], $temp[2], $temp[3], $temp[4]);
                $this->bingoCards[] = $bingoCard;
                $index = 0;
                $temp = array();
                $bingoId++;
                continue;
            }
            $x = explode(" ", $line);
            $temp[$index] = $x;
            $index++;
        }
    }
}

class bingoCard {
    private array $allNumbers;
    private bool $hasWon;

    public function __construct($id) {
        $this->hasWon = false;
        $this->allNumbers = array(array());
    }

    public function setRowNumbers(array ...$numberRow) {
        $rowIndex = 0;
        foreach ($numberRow as $row) {
            $colIndex = 0;
            foreach ($row as $item) {
                $this->allNumbers[$rowIndex][$colIndex] = new bingoSpot((int) $item);
                $colIndex++;
            }
            $rowIndex++;
        }
    }

    public function checkForBingo() {
        $hort = $this->checkHorizontal();
        $vert = $this->checkVertical();

        if ($hort || $vert) {
            $this->hasWon = true;
            return $this->getAllUnmarked();
        }
    }

    private function getAllUnmarked() {
        $unmarked = [];
        foreach ($this->allNumbers as $row) {
            foreach ($row as $item) {
                if (!$item->getSeen()) {
                    $unmarked[] = $item;
                }
            }
        }
        return $unmarked;
    }

    public function scratchNumberOnCard(int $number){
        foreach ($this->allNumbers as $row) {
            foreach ($row as $item) {
                if ($item->getNumber() === $number)
                    $item->setSeen();
            }
        }
    }

    private function checkHorizontal() {
        $horizontalCount = count($this->allNumbers[0]);
        for ($row = 0; $row < $horizontalCount; $row++) {
            if ($this->allNumbers[$row][0]->getSeen() && $this->allNumbers[$row][1]->getSeen() && $this->allNumbers[$row][2]->getSeen() && $this->allNumbers[$row][3]->getSeen() && $this->allNumbers[$row][4]->getSeen()) {
                return [$this->allNumbers[$row]];
            }
        }
        return [];
    }

    private function checkVertical() {
        $verticalCount = count($this->allNumbers);
        for($col = 0; $col < $verticalCount; $col++) {
            if ($this->allNumbers[0][$col]->getSeen() && $this->allNumbers[1][$col]->getSeen() && $this->allNumbers[2][$col]->getSeen() && $this->allNumbers[3][$col]->getSeen() && $this->allNumbers[4][$col]->getSeen()) {
                return [$this->allNumbers[0][$col], $this->allNumbers[1][$col], $this->allNumbers[2][$col], $this->allNumbers[3][$col], $this->allNumbers[4][$col]];
            }
        }
        return [];
    }

    public function hasWon(): bool {
        return $this->hasWon;
    }
}

class bingoSpot
{
    private int $number;
    private bool $seen;

    public function __construct(int $number)
    {
        $this->number = $number;
        $this->seen = false;
    }

    public function setSeen()
    {
        $this->seen = true;
    }

    public function getSeen(): bool
    {
        return $this->seen;
    }

    public function getNumber()
    {
        return $this->number;
    }
}