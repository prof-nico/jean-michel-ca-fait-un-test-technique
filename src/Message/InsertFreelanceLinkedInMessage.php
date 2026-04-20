<?php

namespace App\Message;

use App\Dto\FreelanceLinkedInDto;
use Symfony\Component\Validator\Constraints as Assert;

final class InsertFreelanceLinkedInMessage
{
     public function __construct(
         #[Assert\Valid]
         public FreelanceLinkedInDto $dto
     ) {
     }
}
