<?php

declare(strict_types=1);

namespace App\Interfaces\Shared\Entity;

interface BaseEntityInterface
{
    public function create(array $new_entity_data): array;
    public function update(int $entity_id, array $updated_entity_data): array;
    public function getById(int $entity_id): array;
}
