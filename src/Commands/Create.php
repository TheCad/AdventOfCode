<?php

namespace Thecad\AdventOfCode\Commands;

use RuntimeException;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Dotenv\Dotenv;

#[AsCommand(name: 'create', description: 'Create the solution file, test file and downloads the input')]
class Create extends Command
{
  protected SymfonyStyle $io;
  protected function configure(): void
  {
    new Dotenv()->usePutenv()->bootEnv(dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . '.env');
    $setYear = getenv('YEAR');
    $this
      ->addArgument('day', InputArgument::OPTIONAL, 'For what day do you want to create', (int)date('d'))
      ->addArgument('year', InputArgument::OPTIONAL, 'For what year do you want to create', $setYear ?: date('Y'));
  }

  /**
   * @throws \Exception
   */
  protected function execute(InputInterface $input, OutputInterface $output): int
  {
    $this->io = new SymfonyStyle($input, $output);

    $day = sprintf("%02d", $input->getArgument('day'));
    $year = date('Y', strtotime('1/1/' . $input->getArgument('year')));

    if ($year < 2015 || $year > date('Y')) {
      $this->io->getErrorStyle()->warning(sprintf("Choose different year (%s-%s)", 2015, date('Y')));
      return Command::INVALID;
    }

    $this->io->title(sprintf("Creating solution file for year %d and day %d", $year, $day));

    $solutionPath = sprintf("%s/src/Year%d", dirname(__DIR__, 2), $year);
    $solutionFilepath = sprintf("%s/Day%02d.php", $solutionPath, $day);
    $solutionTemplatePath = sprintf("%s/templates/day_template.txt", dirname(__DIR__, 2));

    $this->createDirectory($solutionPath);

    if ($this->createFile($solutionFilepath)) {
      $this->writeTemplate('solution', $solutionFilepath, $year, $day, $solutionTemplatePath);
    }

    $this->io->title(sprintf("Creating input file for year %d and day %d", $year, $day));
    $this->getInput($year, $day);

    $this->io->title(sprintf("Creating test file for year %d and day %d", $year, $day));

    $testPath = sprintf("%s/tests/Year%d", dirname(__DIR__, 2), $year);
    $testFilePath = sprintf("%s/Day%02dTest.php", $testPath, $day);
    $testTemplatePath = sprintf("%s/templates/test_template.txt", dirname(__DIR__, 2));

    $this->createDirectory($testPath);
    if ($this->createFile($testFilePath)) {
      $this->writeTemplate('test', $testFilePath, $year, $day, $testTemplatePath);
    }

    return Command::SUCCESS;
  }

  function createDirectory(string $path): void
  {
    if (!file_exists($path) && !mkdir($path, 0755, true) && !is_dir($path)) {
      $this->io->error(sprintf('Directory "%s" was not created', $path));
      throw new RuntimeException();
    }
  }

  function createFile(string $filepath): bool
  {
    if (!file_exists($filepath)) {
      if (!fopen($filepath, 'wb')) {
        $this->io->error(sprintf('File "%s" was not created', $filepath));
        throw new RuntimeException();
      }
    } else {
      $this->io->info("File already exists. Skipping...");
      return false;
    }
    return true;
  }

  function writeTemplate(string $type, string $filepath, int $year, int $day, string $templatePath): void
  {
    $file = fopen($filepath, 'wb');
    switch ($type) {
      case 'solution':
        if (file_exists($filepath) && !fwrite($file, sprintf(file_get_contents($templatePath), $year, $day, $year, $day))) {
          $this->io->error(sprintf('File "%s" was not created', $filepath));
          throw new RuntimeException();
        }
        break;
      case 'test':
        if (file_exists($filepath) && !fwrite($file, sprintf(file_get_contents($templatePath), $year, $year, $day, $day, $day, $day))) {
          $this->io->error(sprintf('File "%s" was not created', $filepath));
          throw new RuntimeException();
        }
        break;
      default:
        break;
    }
  }

  /**
   * @throws \Exception
   */
  function getInput(int $year, int $day): void
  {
    (new Dotenv())->usePutenv()->bootEnv(dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . '.env');
    if (!getenv('SESSION')) {
      $this->io->error('Please set your session token in the .env file');
      throw new \Exception();
    }
    $path = sprintf("%s/src/Year%d/inputs", dirname(__DIR__, 2), $year);
    $filepath = sprintf("%s/Day%02d_input.txt", $path, $day);
    if (!file_exists($path) && !mkdir($path, 0755, true) && !is_dir($path)) {
      $this->io->error(sprintf('Directory "%s" was not created', $path));
      throw new RuntimeException();
    }

    if (file_exists($filepath)) {
      $this->io->info("Input file already exists. Skipping...");
      return;
    }

    $url = sprintf("https://adventofcode.com/%d/day/%d/input", $year, $day);
    $curl = \curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_USERAGENT, 'github.com/TheCad/AdventOfCode.git by TheCad<email@thecad.dev>');
    $headers = array(
      sprintf("Cookie: session=%s", getenv('SESSION')),
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    $response = curl_exec($curl);
    curl_close($curl);

    $file = fopen($filepath, 'wb');
    if (!fwrite($file, $response)) {
      $this->io->error(sprintf('File "%s" was not created', $filepath . "input.txt"));
      throw new RuntimeException();
    }
  }
}
