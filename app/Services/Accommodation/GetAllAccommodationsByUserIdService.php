<?php

declare(strict_types=1);

namespace App\Services\Accommodation;

use App\Interfaces\Accommodation\AccommodationRepositoryInterface;

class GetAllAccommodationsByUserIdService
{

    private AccommodationRepositoryInterface $accommodationRepository;
    public function __construct(
        AccommodationRepositoryInterface $accommodationRepository
    ) {
        $this->accommodationRepository = $accommodationRepository;
    }

    public function handle(int $user_id): array
    {
        return $this->accommodationRepository->getAllByUserId($user_id);

    }
}
