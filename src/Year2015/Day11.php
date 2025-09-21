<?php

namespace Thecad\AdventOfCode\Year2015;

use Thecad\AdventOfCode\Base\BaseClass;

class Day11 extends BaseClass
{
    public function __construct()
    {
        $this->relativePath = __DIR__;
        parent::__construct();
    }

    public function partOne(): bool
    {
        $rules = ['rule1', 'rule2', 'rule3'];
        $res = $this->findNextValidString($this->input[0], $rules);

        return false;
    }

    private function rule1($string)
    {
        for ($i = 0; $i < strlen($string) - 2; $i++) {
            if ((ord($string[$i]) == ord($string[$i + 1]) - 1) && (ord($string[$i] === ord($string[$i + 2]) - 2))) {
                return true;
            } else {
                return false;
            }
        }
    }

    private function rule2($string)
    {
        return false;
    }

    private function rule3($string)
    {
        return false;
    }

    private function validateAllRules($string, $rules)
    {
        return collect($rules)->every(fn ($rule) => $this->$rule($string));
    }

    private function findNextValidString($startString, $rules)
    {
        $current = $startString;
        while (! $this->validateAllRules($current, $rules)) {
            $current = $this->incrementString($current);
        }

        return $current;
    }

    private function incrementString(string $string): string
    {

        return '';
    }

    public function partTwo(): int
    {
        // Create solution

        return 0;
    }
}
