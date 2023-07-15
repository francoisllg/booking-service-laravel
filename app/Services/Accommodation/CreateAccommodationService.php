<?php

declare(strict_types=1);

namespace App\Services\Accommodation;

use App\Interfaces\Accommodation\AccommodationRepositoryInterface;

class CreateAccommodationService
{
    private AccommodationRepositoryInterface $accommodationRepository;
    public function __construct(
        AccommodationRepositoryInterface $accommodationRepository
    ) {
        $this->accommodationRepository = $accommodationRepository;
    }

    public function handle(array $new_accommodation_data): array
    {
        return $this->accommodationRepository->create($new_accommodation_data);
    }
}
