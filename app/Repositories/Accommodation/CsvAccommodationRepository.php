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

    public function update(array $updated_accommodation_data): array
    {
        return [];
    }

    public function getAllByUserId(int $user_id): array
    {
        return isset($this->data[$user_id])
            ? $this->formatData($this->data[$user_id])['accommodations']
            : [];
    }

    public function getById(int $id): array
    {
        return [];
    }



}
