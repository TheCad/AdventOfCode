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

function run(int $day, int $year, bool $runAll): void {
    dump($day, $year, $runAll);
}

function create(int $day, int $year): void {
    dump(sprintf("Creating solution file for year %d and day %d", $year, $day));

    $path = sprintf("%s/src/Year%d", __DIR__ , $year);
    $filepath = sprintf("%s/Day%02d.php", $path , $day);

    createDirectory($path);
    createFile($filepath);
    writeTemplate($filepath, $year, $day);
}

function createDirectory(string $path): void {
    if (!file_exists($path) && !mkdir($path, 0755, true) && !is_dir($path)) {
        throw new \RuntimeException(sprintf('Directory "%s" was not created', $path));
    }
}

function createFile(string $filepath): void {
    if (!file_exists($filepath)) {
        if (!fopen($filepath, 'wb')) {
            throw new \RuntimeException(sprintf('File "%s" was not created', $filepath));
        }
    } else {
        dump("File already exists. Skipping...");
    }
}

function writeTemplate(string $filepath, int $year, int $day): void {
    $template = __DIR__."/templates/day_template.txt";
    $file = fopen($filepath, 'wb');
    if (file_exists($filepath) && !fwrite($file, sprintf(file_get_contents($template), $year, $day))) {
        throw new \RuntimeException(sprintf('File "%s" was not created', $filepath));
    }
}