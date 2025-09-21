<?php

namespace Thecad\AdventOfCode\Year2015;

use Thecad\AdventOfCode\Base\BaseClass;

class Day07 extends BaseClass
{
    public $wires = [];

    public $op = ['AND' => '&', 'OR' => '|', 'NOT' => '~', 'RSHIFT' => '>>', 'LSHIFT' => '<<'];

    public function __construct()
    {
        $this->relativePath = __DIR__;
        parent::__construct();

        foreach ($this->input as $line) {
            [$k, $v] = explode(' -> ', $line);
            $wires[$v] = $k;
        }
    }

    public function partOne(): int
    {
        $x = $this->x('a');
        dump($x);

        return 0;
    }

    public function partTwo(): int
    {
        // Create solution

        return 0;
    }

    public function x($wire)
    {
        if (! isset($this->wires[$wire])) {
            return $wire;
        }
        if (strpos($this->wires[$wire], ' ') !== false) {
            eval('$wires[$wire] = ('.preg_replace_callback('#(([a-z0-9]+) )?[A-Z]+) ([a-z0-9]+)#', function ($p) {
                return $this->x($p[2]).$this->op[$p[3]].$this->x($p[4]);
            }, $this->wires[$wire]).' & 65535);');

            return $this->x($this->wires[$wire]);
        }
    }
}
