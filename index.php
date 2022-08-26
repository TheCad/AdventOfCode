<?php
use Garden\Cli\Cli;

require 'vendor/autoload.php';

$cli = Cli::Create()
    ->command('run')
    ->description('Runs the script of the given year and day ')
    ->opt('all:a', 'Runs all', false, 'boolean')
    ->arg('day', 'What day', false)
    ->arg('year', 'What Year', false)
    ->command('create')
    ->description('Creates the boilerplate for the given year and day')
    ->arg('day', 'What day', true)
    ->arg('year', 'What Year', false);

try {
    $args = $cli->parse($argv);
} catch (Exception $e) {
    dd($e->getMessage());
}

$command = $args->getCommand();
$runAll = $args->getOpt('all');

$year = $runAll ? '' : $args->getArg('year', 2022);
$day = $args->getArg('day');

dump(sprintf("Command: %s, Year: %s, Day: %s, runall: %b", $command, $year, $day, $runAll));