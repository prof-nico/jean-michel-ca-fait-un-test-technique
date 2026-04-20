<?php

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class FreelanceJeanPaulDto
{
    //uniformisation
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\NotNull]
        public string $firstName,
        #[Assert\NotBlank]
        #[Assert\NotNull]
        public string $lastName,
        #[Assert\NotBlank]
        public ?string $jobTitle,
        #[Assert\Type('integer')]
        public int $jeanPaulId
    )
    {
    }
}