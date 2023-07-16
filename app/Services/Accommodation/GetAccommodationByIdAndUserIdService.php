<?php

declare(strict_types=1);

namespace App\Services\Accommodation;

use App\Interfaces\Accommodation\AccommodationRepositoryInterface;

class GetAccommodationByIdAndUserIdService
{
        private AccommodationRepositoryInterface $accommodationRepository;

        public function __construct(AccommodationRepositoryInterface $accommodationRepository)
        {
            $this->accommodationRepository = $accommodationRepository;
        }

        public function handle(int $accommodation_id, int $user_id): array
        {
            return $this->accommodationRepository->getByIdAndUserId($accommodation_id, $user_id);
        }

}
