<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class RandomSpellCommand extends Command
{
    protected static $defaultName = 'app:random-spell';

    protected function configure()
    {
        $this
            ->setDescription('Cast an powerful attack...')
            ->addArgument('your-name', InputArgument::OPTIONAL, 'Your current name.')
            ->addOption('attack', null, InputOption::VALUE_NONE, 'specify attack.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $yourName = $input->getArgument('your-name');
        if ($yourName) {
            $io->note("Hi $yourName");
        }

        $powerAttacks = ['kameha', 'finalFlash', 'masenko', 'WAT'];
        $powerAttack = $powerAttacks[random_int(0, count($powerAttacks))];
        if ($input->getOption('attack')) {
            $powerAttack = strtoupper($powerAttack);
        }

        $io->success($powerAttack);

        return Command::SUCCESS;
    }
}
