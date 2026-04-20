<?php

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class FreelanceLinkedInDto
{

    //difficile comme choix entre modifier le json ou permettre le not null, dépend de la partie domaine mais le TU insinue plutôt ce changement là
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\NotNull]
        public string $firstName,
        #[Assert\NotBlank]
        #[Assert\NotNull]
        public string $lastName,
        #[Assert\NotBlank]
        public ?string $jobTitle,
        #[Assert\NotBlank]
        #[Assert\NotNull]
        public string $url
    )
    {
    }
}