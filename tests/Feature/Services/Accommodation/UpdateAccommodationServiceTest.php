<?php

declare(strict_types=1);

namespace Tests\Feature\Services\Accommodation;

use Tests\TestCase;
use App\Exceptions\Shared\Entity\UpdateEntityException;
use App\Exceptions\Shared\Entity\EntityNotFoundException;
use App\Services\Accommodation\UpdateAccommodationService;

class UpdateAccommodationServiceTest extends TestCase
{
    private $updateAccommodationService;
    public function setUp(): void
    {
        parent::setUp();
        $this->updateAccommodationService = $this->app->make(UpdateAccommodationService::class);
    }

    /**
     * @test
     */
    public function service_can_update_an_accommodation()
    {
        //arrange
        $accommodationId = 1;
        $updatedAccommodationData = [
            'id' => 1,
            'user_id' => 275,
            'name' => 'Updated name',
            'type' => 'Updated type',
            'city' => 'Updated city',
            'address' => 'Updated address',
            'country' => 'Updated country',
            'postal_code' => 'Updated postal code',
            'max_guests' => 2,
        ];

        //act
        $result = $this->updateAccommodationService->handle($accommodationId, $updatedAccommodationData);

        //assert
        $this->assertIsArray($result);

    }

    /**
     * @test
     */
    public function service_cannot_update_an_accommodation_if_the_user_id_is_not_provided()
    {
        //arrange
        $accommodationId = 1;
        $updatedAccommodationData = [
            'id' => 1,
            'name' => 'Updated name',
            'type' => 'Updated type',
            'city' => 'Updated city',
            'address' => 'Updated address',
            'country' => 'Updated country',
            'postal_code' => 'Updated postal code',
            'max_guests' => 2,
        ];

        //act //assert
        $this->expectException(UpdateEntityException::class);
        $this->updateAccommodationService->handle($accommodationId, $updatedAccommodationData);

    }
    /**
     * @test
     */
    public function service_cannot_update_an_accommodation_if_the_accommodation_does_not_exist()
    {
        //arrange
        $accommodationId = 1;
        $updatedAccommodationData = [
            'id' => 9999,
            'user_id' => 275,
            'name' => 'Updated name',
            'type' => 'Updated type',
            'city' => 'Updated city',
            'address' => 'Updated address',
            'country' => 'Updated country',
            'postal_code' => 'Updated postal code',
            'max_guests' => 2,
        ];

        //act //assert
        $this->expectException(EntityNotFoundException::class);
        $this->updateAccommodationService->handle($accommodationId, $updatedAccommodationData);

    }
}
