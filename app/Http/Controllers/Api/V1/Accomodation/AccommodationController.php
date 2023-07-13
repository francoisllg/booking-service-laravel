<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Accommodation\CreateAccommodationRequest;
use App\Http\Requests\Accommodation\UpdateAccommodationRequest;

class AccommodationController extends ApiController
{
    public function create(CreateAccommodationRequest $request, int $user_id): JsonResponse
    {
    }
    public function update(UpdateAccommodationRequest $request, int $user_id, int $accommodation_id): JsonResponse
    {
    }
    public function getAll(int $user_id): JsonResponse
    {
    }

}
