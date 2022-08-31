<?php
use Garden\Cli\Cli;
use Symfony\Component\Dotenv\Dotenv;

require 'vendor/autoload.php';

$cli = Cli::Create()
    ->command('run')
    ->description('Runs the script of the given year and day ')
    ->opt('all:a', 'Runs all', false, 'boolean')
    ->arg('day', 'What day')
    ->arg('year', 'What Year')
    ->command('create')
    ->description('Creates the boilerplate for the given year and day')
    ->arg('day', 'What day', true)
    ->arg('year', 'What Year');

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
        dd("BROKEN");
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

    dump(sprintf("Creating input file for year %d and day %d", $year, $day));
    getInput($year, $day);

    dump(sprintf("Creating test file for year %d and day %d", $year, $day));

    $testPath = "";
    $testFilePath = "";

    createTestDirectory($testPath); // Todo implement this
    createTestFile($testFilePath); // Todo implement this
    writeTestTemplate($testFilePath, $year, $day); // Todo implement this
}

function createTestDirectory(string $testPath): void {
    // Todo implement this
}

function writeTestTemplate(string $testFilePath, int $year, int $day): void {
    // Todo implement this
}

function createTestFile(string $testFilePath): void {
    // Todo implement this
}

function createDirectory(string $path): void {
    if (!file_exists($path) && !mkdir($path, 0755, true) && !is_dir($path)) {
        throw new RuntimeException(sprintf('Directory "%s" was not created', $path));
    }
}

function createFile(string $filepath): void {
    if (!file_exists($filepath)) {
        if (!fopen($filepath, 'wb')) {
            throw new RuntimeException(sprintf('File "%s" was not created', $filepath));
        }
    } else {
        dump("Solution file already exists. Skipping...");
    }
}

function writeTemplate(string $filepath, int $year, int $day): void {
    $template = __DIR__."/templates/day_template.txt";
    $file = fopen($filepath, 'wb');
    if (file_exists($filepath) && !fwrite($file, sprintf(file_get_contents($template), $year, $day))) {
        throw new RuntimeException(sprintf('File "%s" was not created', $filepath));
    }
}

function getInput(int $year, int $day): void
{
    $path = sprintf("%s/src/Year%d/inputs", __DIR__ , $year);
    $filepath = sprintf("%s/Day%02d_input.txt", $path, $day);
    if (!file_exists($path) && !mkdir($path, 0755, true) && !is_dir($path)) {
        throw new RuntimeException(sprintf('Directory "%s" was not created', $path));
    }

    if (file_exists($filepath)) {
        dump("Input file already exists. Skipping...");
        return;
    }

    (new Dotenv())->usePutenv()->bootEnv(__DIR__.'/.env');

    $url = sprintf("https://adventofcode.com/%d/day/%d/input", $year, $day);
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $headers = array(
        sprintf("Cookie: session=%s", getenv('SESSION')),
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    $response = curl_exec($curl);
    curl_close($curl);

    $file = fopen($filepath, 'wb');
    if (!fwrite($file, $response)) {
        throw new RuntimeException(sprintf('File "%s" was not created', $filepath . "input.txt"));
    }
}