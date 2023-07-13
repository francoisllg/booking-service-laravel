<?php

declare(strict_types=1);

namespace App\Repositories\Accommodation;
use App\Interfaces\Accommodation\AccommodationRepositoryInterface;

class InMemoryAccommodationRepository implements AccommodationRepositoryInterface
{
    public function create(array $new_accommodation_data): array{
        $result = array_merge(['id' => 1], $new_accommodation_data);
        $result['updated_at'] = now()->toDateString();
        return $result;
    }

    public function update(array $updated_accommodation_data): array{
        return [];
    }
    public function getAllByUserId(int $user_id): array{
        return [];
    }
}
