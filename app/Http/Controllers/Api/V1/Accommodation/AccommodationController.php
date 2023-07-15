<?php

namespace App\Http\Controllers\Api\V1\Accommodation;

use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Services\User\GetUserByIdService;
use App\Http\Controllers\Api\ApiController;
use App\Services\Accommodation\CreateAccommodationService;
use App\Http\Resources\Accommodation\AccommodationResource;
use App\Http\Requests\Accommodation\CreateAccommodationRequest;
use App\Http\Requests\Accommodation\UpdateAccommodationRequest;
use App\Services\Accommodation\GetAllAccommodationsUpdatedOnWeekendsByUserIdService;

class AccommodationController extends ApiController
{

    private GetUserByIdService $getUserByIdService;
    private CreateAccommodationService $createAccommodationService;
    private GetAllAccommodationsUpdatedOnWeekendsByUserIdService $getAllAccommodationsUpdatedOnWeekendsByUserIdService;

    public function __construct(
        GetUserByIdService $get_user_by_id_service,
        CreateAccommodationService $create_accommodation_service,
        GetAllAccommodationsUpdatedOnWeekendsByUserIdService $get_all_accommodations_updated_on_weekends_by_user_id_service
    ) {
        $this->getUserByIdService = $get_user_by_id_service;
        $this->createAccommodationService = $create_accommodation_service;
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

        } catch (\Throwable $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }

    public function getAllByUserId(int $user_id): JsonResponse
    {
        try {
            if (empty($this->getUserByIdService->handle($user_id))) {
                return $this->errorResponse('User not found', Response::HTTP_BAD_REQUEST);
            }
            $accommodations = $this->getAllAccommodationsUpdatedOnWeekendsByUserIdService->handle($user_id);
            return $this->successResponse(AccommodationResource::collection($accommodations), Response::HTTP_OK);
        } catch (\Throwable $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }

}
