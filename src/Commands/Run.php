<?php

namespace Thecad\AdventOfCode\Commands;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Dotenv\Dotenv;

#[AsCommand(name: 'run', description: 'Runs the given year and day.')]
class Run extends Command
{
    protected SymfonyStyle $io;

    protected function configure()
    {
        (new Dotenv)->usePutenv()->bootEnv(dirname(__DIR__, 2).DIRECTORY_SEPARATOR.'.env');
        $setYear = getenv('YEAR');
        $this
            ->addArgument('day', InputArgument::OPTIONAL, 'What day do you want to run?', (int) date('d'))
            ->addArgument('year', InputArgument::OPTIONAL, 'What year do you want to run?', $setYear ?: date('Y'))
            ->addArgument('part', InputArgument::OPTIONAL, 'Which part do you want to run?', null);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->io = new SymfonyStyle($input, $output);

        $day = sprintf('%02d', $input->getArgument('day'));
        $year = date('Y', strtotime('1/1/'.$input->getArgument('year')));
        $part = $input->getArgument('part');

        $file = sprintf("Thecad\AdventOfCode\Year%d\Day%02d", $year, $day);
        if (! class_exists($file)) {
            $this->io->error('This day has not yet been created');

            return Command::INVALID;
        }
        $class = new $file;

        switch ($part) {
            case 1:
                $this->io->definitionList(
                    ['Part 1' => $this->partOne($class)],
                );
                break;
            case 2:
                $this->io->definitionList(
                    ['part 2' => $this->partTwo($class)],
                );
                break;
            default:
                $this->io->definitionList(
                    ['Part 1' => $this->partOne($class)],
                    ['part 2' => $this->partTwo($class)],
                );
                break;
        }

        return Command::SUCCESS;
    }

    private function partOne($class)
    {
        $start = microtime(true);
        $part = $class->partOne();
        $end = microtime(true);

        return sprintf('%d took %f ms', $part, ($end - $start));
    }

    private function partTwo($class)
    {
        $start = microtime(true);
        $part = $class->partTwo();
        $end = microtime(true);

        return sprintf('%d took %f ms', $part, ($end - $start));
    }
}
