<?php

namespace App\Command;

use App\Entity\Freelance;
use App\Service\FreelanceConsolider;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:consolidate:freelance',
    description: 'Normalize freelance',
)]
class ConsolidateFreelanceCommand extends Command
{
    public function __construct(private readonly FreelanceConsolider $freelanceConsolider, private readonly EntityManagerInterface $entityManager)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $batchSize = 100;
        $offset = 0;
        do {
            $freelances = $this->entityManager->getRepository(Freelance::class)->findBy([], null, $batchSize, $offset);
            /** @var Freelance $freelance */
            foreach ($freelances as $freelance) {
                $this->freelanceConsolider->consolidate($freelance);
            }
            $this->entityManager->flush();
            $this->entityManager->clear();
            $offset += $batchSize;
        } while (count($freelances) === $batchSize);

        return Command::SUCCESS;
    }
}
