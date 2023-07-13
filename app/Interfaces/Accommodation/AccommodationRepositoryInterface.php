<?php

declare(strict_types=1);

namespace App\Interfaces\Accommodation;

interface AccommodationRepositoryInterface
{
    public function create(array $new_accommodation_data): array;
    public function update(array $updated_accommodation_data): array;
    public function getAllByUserId(int $user_id): array;
}
