<?php

namespace Thecad\AdventOfCode\Base;

class BaseClass {
    protected array $input = [];
    protected string $relativePath = '';
    private string $inputFile;

    public function __construct() {
        $pos = strrpos(get_class($this), '\\');
        $this->inputFile = sprintf("%s_input.txt", substr(get_class($this), $pos + 1));
        $this->readInput();
    }

    private function readInput(): void {
        $file = fopen(sprintf("%s/inputs/%s", $this->relativePath, $this->inputFile), 'rb');
        while(($line = fgets($file)) !== false) {
            $this->input[] = trim($line);
        }
        fclose($file);
    }

    public function setTestInput(array $input): void {
        $this->input = $input;
    }
}