<?php

namespace Thecad\AdventOfCode\Base;

class BaseClass {
    protected $input = [];

    public function __construct() {
        $this->readInput();
    }

    private function readInput(): void {
        // Doe iets
    }
}