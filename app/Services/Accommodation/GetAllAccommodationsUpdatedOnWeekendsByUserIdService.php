<?php

declare(strict_types=1);

namespace App\Services\Accommodation;

use App\Services\Accommodation\GetAllAccommodationsByUserIdService;

class GetAllAccommodationsUpdatedOnWeekendsByUserIdService
{
    private GetAllAccommodationsByUserIdService $getAllAccommodationsByUserIdService;

    public function __construct(GetAllAccommodationsByUserIdService $getAllAccommodationsByUserIdService)
    {
        $this->getAllAccommodationsByUserIdService = $getAllAccommodationsByUserIdService;
    }

    public function handle(int $user_id): array
    {
        $accommodations = $this->getAllAccommodationsByUserIdService->handle($user_id);
        return array_filter($accommodations, function ($accommodation) {
            return $this->isWeekend($accommodation['updated_at']);
        });
    }

    private function isWeekend(string $date): bool
    {
        $date = strtotime($date);
        $day  = date('l', $date);
        return $day == 'Saturday' || $day == 'Sunday';
    }
}
