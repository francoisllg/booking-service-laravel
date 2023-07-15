<?php

declare(strict_types=1);

namespace App\Services\User;

use App\Interfaces\User\UserRepositoryInterface;

class GetUserByIdService
{

    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $user_repository)
    {
        $this->userRepository = $user_repository;
    }

    public function handle(int $user_id): array
    {
        return $this->userRepository->getById($user_id);
    }
}
