<?php

namespace Lyon1\Bundle\PoobleBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class PurgeAnswersCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('pooble:purge:answers')
            ->setDescription('Remove all survey answers')
            ->addOption('force', null, InputOption::VALUE_NONE, 'Will performe the purge')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Start the purge');

        $em = $this
            ->getContainer()
            ->get('doctrine.orm.entity_manager')
        ;

        $answers = $em
            ->getRepository('PoobleBundle:SurveyAnswer')
            ->findAll()
        ;

        foreach ($answers as $answer) {
            if ($input->getOption('force')) {
                $em->remove($answer);
            }

            $output->writeln(sprintf('Remove answer [%d - %s] done',
                $answer->getId(),
                $answer->getName()
            ));
        }
        $em->flush();

        $output->writeln(sprintf(
            'Purge ended, %d answers processed',
            count($answers)
        ));
    }
}
