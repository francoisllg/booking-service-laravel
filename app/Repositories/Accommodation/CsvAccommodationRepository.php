<?php

declare(strict_types=1);

namespace App\Repositories\Accommodation;

use App\Repositories\Shared\BaseCsvRepository;
use App\Interfaces\Accommodation\AccommodationRepositoryInterface;

class CsvAccommodationRepository extends BaseCsvRepository implements AccommodationRepositoryInterface
{

    public function create(array $new_accommodation_data): array
    {
        $result = array_merge(['id' => 1], $new_accommodation_data);
        $result['updated_at'] = now()->toDateTimeString();
        return $result;
    }

    public function update(int $accommodation_id, array $updated_accommodation_data): array
    {
        $updated_accommodation_data['updated_at'] = now()->toDateTimeString();
        return $updated_accommodation_data;
    }

    public function getAllByUserId(int $user_id): array
    {
        return isset($this->data[$user_id])
            ? $this->formatAccommodationCollection($this->data[$user_id])['accommodations']
            : [];
    }

    public function getByIdAndUserId(int $accommodation_id, int $user_id): array
    {
        if(isset($this->data[$user_id])) {
            foreach($this->data[$user_id]['accommodations'] as $accommodation) {
                if(intval($accommodation['accommodation_id']) === $accommodation_id) {
                    $result = $this->formatAccommodationData($accommodation);
                    break;
                }
            }
        }
        return $result ?? [];
    }

    public function getById(int $id): array
    {
        //default implementation
        return [];
    }

}
