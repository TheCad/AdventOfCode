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
$runAll = (bool)$args->getOpt('all');
$year = (int)($runAll ? 0 : $args->getArg('year', 2022));
$day = (int)$args->getArg('day');

switch ($command) {
    case 'run':
        run($day, $year, $runAll);
        break;
    case 'create':
        create($day, $year);
        break;
    default:
        dump("KAPOT");
        break;
}

function run(int $day, int $year, bool $runAll) : void {
    dump($day, $year, $runAll);
}

function create(int $day, int $year) : void {
    dump($day, $year);
}