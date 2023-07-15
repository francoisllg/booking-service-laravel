<?php

declare(strict_types=1);

namespace App\Interfaces\Accommodation;
use App\Interfaces\Shared\Entity\BaseEntityInterface;

interface AccommodationRepositoryInterface extends BaseEntityInterface
{
    public function getAllByUserId(int $user_id): array;
}
