<?php

declare(strict_types=1);

namespace App\Repositories\User;

use App\Repositories\Shared\BaseCsvRepository;
use App\Interfaces\User\UserRepositoryInterface;

class CsvUserRepository extends BaseCsvRepository implements UserRepositoryInterface
{
    public function create(array $new_user_data): array
    {
        //default implementation
        return [];
    }

    public function update(array $updated_user_data): array
    {
        //default implementation
        return [];
    }

    public function getById(int $user_id): array
    {
        return isset($this->data[$user_id])
            ? ['id' => $this->data[$user_id]['user_id'], 'name' => $this->data[$user_id]['user_name']]
            : [];
    }


}
