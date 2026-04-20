<?php
namespace App\Service;

use App\Entity\FreelanceConso;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

readonly class FreelanceManager
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private HttpClientInterface $httpClient,
    ) {
    }

    public function findTheMostUseFirstname(): ?string
    {
        //je follow que ce soit declaré dans le repo mais en fonction du nombre, why not utiliser ES
        //si on est chaud on met en cache également
        return $this->entityManager->getRepository(FreelanceConso::class)->findTheMostUseFirstname()['firstName'] ?? null;
    }

    // More or less 176k freelances. It would be cool if jean-michel.io had a public API.
    public function getNumberOfFreelancesInJeanMichelWebsiteHomePage(): int
    {
        try {
            $data = $this->httpClient->request('GET', 'https://godzilla.jean-michel.io/metrics')->toArray();
            return (int) $data['total_global_freelances'];
        } catch (\Throwable) {
            //si on est chaud on keep la data dans du cache au cas où on rentre dans ce catch on renvoie la dernière value connue
            return 0;
        }
    }
}