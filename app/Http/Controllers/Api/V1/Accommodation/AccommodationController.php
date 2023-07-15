<?php

namespace App\Http\Controllers\Api\V1\Accommodation;

use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Api\ApiController;
use App\Services\Accommodation\CreateAccommodationService;
use App\Http\Resources\Accommodation\AccommodationResource;
use App\Http\Requests\Accommodation\CreateAccommodationRequest;
use App\Http\Requests\Accommodation\UpdateAccommodationRequest;

class AccommodationController extends ApiController
{

    private CreateAccommodationService $createAccommodationService;
    public function __construct(
        CreateAccommodationService $create_accommodation_service
    ) {
        $this->createAccommodationService = $create_accommodation_service;
    }

    public function create(CreateAccommodationRequest $request, int $user_id): JsonResponse
    {
        try{
            $newAccomodationData = $request->validated();
            $newAccomodationData['user_id'] = $user_id;
            $accommodation = $this->createAccommodationService->handle($newAccomodationData);
            return $this->successResponse(new AccommodationResource($accommodation), Response::HTTP_CREATED);
        } catch (\Throwable $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(UpdateAccommodationRequest $request, int $user_id, int $accommodation_id): JsonResponse
    {
    }
    public function getAll(int $user_id): JsonResponse
    {
    }

}
