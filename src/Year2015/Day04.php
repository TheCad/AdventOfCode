<?php

namespace Thecad\AdventOfCode\Year2015;

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
        $input = $this->input[0];
        $number = 0;
        while (! str_starts_with(md5($input.$number), '00000')) {
            $number++;
        }

        return $number;
    }

    public function partTwo(): int
    {
        $input = $this->input[0];
        $number = 0;
        while (! str_starts_with(md5($input.$number), '000000')) {
            $number++;
        }

        return $number;
    }
}
