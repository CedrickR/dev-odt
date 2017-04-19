<?php
namespace Odt\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

use Symfony\Component\Console\Formatter\OutputFormatterStyle;


class CafCommand extends Command 
{
    protected function configure() {
         $this
            ->setName('caf:test')
            ->setDescription("Ceci est une commande de test")
             /*
             ->addArgument(
                'fichiers',
                InputArgument::REQUIRED | InputArgument::IS_ARRAY,
                'Les noms de fichier MOF à traiter'
                )/*
            ->addOption(
               'type',
               null,
               InputOption::VALUE_REQUIRED ,
               'Le type de fichier à parser : LOCAL, NATIONAL'
                )*/

        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output) {


      
        //Affihag des données
        $style = new OutputFormatterStyle('red', 'yellow', array('bold', 'blink'));
        $output->getFormatter()->setStyle('fire', $style);
        $titre = "<fire>Ceci est une commande de test</fire>";
        $output->writeln($titre);

    }


}
