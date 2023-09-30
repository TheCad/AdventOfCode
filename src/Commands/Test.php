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

#[AsCommand(name: 'test')]
class Test extends Command {
    protected SymfonyStyle $io;
    protected function configure(): void {
        (new Dotenv())->usePutenv()->bootEnv(dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . '.env');
        $setYear = getenv('YEAR');
        $this
            ->addArgument('day', InputArgument::OPTIONAL, 'For what day do you want to create', (int)date('d'))
            ->addArgument('year', InputArgument::OPTIONAL, 'For what year do you want to create', $setYear ?: date('Y'));
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $this->io = new SymfonyStyle($input, $output);

        $day = sprintf("%02d", $input->getArgument('day'));
        $year = date('Y', strtotime('1/1/'.$input->getArgument('year')));

        $testPath = sprintf("%s/tests/Year%d", dirname(__DIR__, 2), $year);
        $testFilePath = sprintf("%s/Day%02dTest.php", $testPath, $day);

        if (!file_exists($testFilePath)) {
            $this->io->error(sprintf('There is no test for day %d and year %d', $day, $year));
            return Command::FAILURE;
        }
        $this->io->text(shell_exec(sprintf('./vendor/bin/phpunit --color %s',$testFilePath)));

        return Command::SUCCESS;
    }
}