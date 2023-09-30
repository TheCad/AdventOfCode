<?php

namespace Thecad\AdventOfCode\Commands;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Dotenv\Dotenv;

#[AsCommand(name: 'run')]
class Run extends Command {
    protected SymfonyStyle $io;

    protected function configure() {
        (new Dotenv())->usePutenv()->bootEnv(dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . '.env');
        $setYear = getenv('YEAR');
        $this
            ->addArgument('day', InputArgument::OPTIONAL, 'For what day do you want to create', (int)date('d'))
            ->addArgument('year', InputArgument::OPTIONAL, 'For what year do you want to create', $setYear ?: date('Y'))
            ->addArgument('part', InputArgument::OPTIONAL, 'Which part do you want to run?', null);
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $this->io = new SymfonyStyle($input, $output);

        $day = sprintf("%02d", $input->getArgument('day'));
        $year = date('Y', strtotime('1/1/'.$input->getArgument('year')));
        $part = $input->getArgument('part');

        $file = sprintf("Thecad\AdventOfCode\Year%d\Day%02d", $year, $day);
        if (!class_exists($file)) {
            $io->error("This day has not yet been created");
            return Command::INVALID;
        }
        $class = new $file();

        switch ($part) {
            case 1:
                $this->io->section('Running part 1');
                $this->io->text($class->partOne());
                break;
            case 2:
                $this->io->section('Running part 2');
                $this->io->text($class->partTwo());
                break;
            default:
                $this->io->section('Running part 1');
                $this->io->text($class->partOne());
                $this->io->section('Running part 2');
                $this->io->text($class->partTwo());
        }

        return Command::SUCCESS;
    }
}