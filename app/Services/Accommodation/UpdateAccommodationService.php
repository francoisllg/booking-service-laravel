<?php

declare(strict_types=1);

namespace App\Services\Accommodation;

use App\Exceptions\Shared\Entity\EntityNotFoundException;
use App\Exceptions\Shared\Entity\UpdateEntityException;
use App\Interfaces\Accommodation\AccommodationRepositoryInterface;
use App\Services\Accommodation\GetAccommodationByIdAndUserIdService;

class UpdateAccommodationService
{

    private AccommodationRepositoryInterface $accommodationRepository;
    private GetAccommodationByIdAndUserIdService $getAccommodationByIdAndUserIdService;

    public function __construct
    (
        AccommodationRepositoryInterface $accommodation_repository,
        GetAccommodationByIdAndUserIdService $get_accommodation_by_id_and_user_id_service
    ) {
        $this->accommodationRepository = $accommodation_repository;
        $this->getAccommodationByIdAndUserIdService = $get_accommodation_by_id_and_user_id_service;
    }

    public function handle(int $accommodation_id, array $updated_accommodation_data): array
    {
        $updatedAccommodationData = $this->setAllAccommodationDataUpdated($updated_accommodation_data);
        return $this->accommodationRepository->update($accommodation_id, $updatedAccommodationData);
    }

    private function setAllAccommodationDataUpdated(array $updated_accommodation_data): array
    {

        if(empty($updated_accommodation_data['user_id'])){
            throw new UpdateEntityException('User id is required. Update aborted.');
        }

        $currentAccommodation = $this->getAccommodationByIdAndUserIdService->handle($updated_accommodation_data['id'], $updated_accommodation_data['user_id']);
        if(empty($currentAccommodation)) {
            throw new EntityNotFoundException('Accommodation not found. Update aborted.');
        }
        $possibleAccomodationUpdate = array_merge($currentAccommodation, $updated_accommodation_data);
        if ($possibleAccomodationUpdate['max_guests'] > $possibleAccomodationUpdate['distribution']['beds']) {
            throw new UpdateEntityException('Max guests cannot be more than beds. Update aborted.');
        }
        unset($possibleAccomodationUpdate['user_id']);
        return $possibleAccomodationUpdate;
    }
}
