<?php

namespace App\Http\Controllers\Api\V1\Accommodation;

use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Api\ApiController;
use App\Services\Accommodation\CreateAccommodationService;
use App\Services\Accommodation\UpdateAccommodationService;
use App\Http\Resources\Accommodation\AccommodationResource;
use App\Http\Requests\Accommodation\CreateAccommodationRequest;
use App\Http\Requests\Accommodation\UpdateAccommodationRequest;
use App\Services\Accommodation\GetAllAccommodationsUpdatedOnWeekendsByUserIdService;

class AccommodationController extends ApiController
{
    private CreateAccommodationService $createAccommodationService;
    private UpdateAccommodationService $updateAccommodationService;
    private GetAllAccommodationsUpdatedOnWeekendsByUserIdService $getAllAccommodationsUpdatedOnWeekendsByUserIdService;

    public function __construct(
        CreateAccommodationService $create_accommodation_service,
        UpdateAccommodationService $update_accommodation_service,
        GetAllAccommodationsUpdatedOnWeekendsByUserIdService $get_all_accommodations_updated_on_weekends_by_user_id_service
    ) {
        $this->createAccommodationService = $create_accommodation_service;
        $this->updateAccommodationService = $update_accommodation_service;
        $this->getAllAccommodationsUpdatedOnWeekendsByUserIdService = $get_all_accommodations_updated_on_weekends_by_user_id_service;
    }

    public function create(CreateAccommodationRequest $request, int $user_id): JsonResponse
    {
        try {
            $newAccomodationData = $request->validated();
            $newAccomodationData['user_id'] = $user_id;
            $accommodation = $this->createAccommodationService->handle($newAccomodationData);
            return $this->successResponse(new AccommodationResource($accommodation), Response::HTTP_CREATED);
        } catch (\Throwable $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }

    public function update(UpdateAccommodationRequest $request, int $user_id, int $accommodation_id): JsonResponse
    {
        try {
            $updatedAccomodationData = $request->validated();
            $updatedAccomodationData['user_id'] = $user_id;
            $updatedAccommodation = $this->updateAccommodationService->handle($accommodation_id, $updatedAccomodationData);
            return $this->successResponse(new AccommodationResource($updatedAccommodation), Response::HTTP_OK);
        } catch (\Throwable $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }

    public function getAllByUserId(int $user_id): JsonResponse
    {
        try {
            $accommodations = $this->getAllAccommodationsUpdatedOnWeekendsByUserIdService->handle($user_id);
            return $this->successResponse(AccommodationResource::collection($accommodations), Response::HTTP_OK);
        } catch (\Throwable $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }
}
