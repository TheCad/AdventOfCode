<?php
use Garden\Cli\Cli;

require 'vendor/autoload.php';

$cli = Cli::Create()
    ->command('run')
    ->description('Runs the script of the given year and day ')
    ->opt('year:y', 'What year', false, 'integer')
    ->opt('day:d', 'What day', false, 'integer')
    ->opt('all:a', 'Runs all', false, 'boolean')
    ->command('create')
    ->description('Creates the boilerplate for the given year and day')
    ->opt('year:y', 'What year', true, 'integer')
    ->opt('day:d', 'What day', true, 'integer');

try {
    $args = $cli->parse($argv);
} catch (Exception $e) {
    dd($e->getMessage());
}



dump("Command: " . $args->getCommand(), "Year: " . $args->getOpt('year'), "Day: " . $args->getOpt('day'),  $args->getOpt('all') ? "All?: True" :  "All?: False");


//$test = new Thecad\AdventOfCode\Test();
//$test->bla();