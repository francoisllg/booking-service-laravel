<?php

declare(strict_types=1);

namespace Tests\Feature\Services\Accommodation;

use Tests\TestCase;
use App\Services\Accommodation\GetAllAccommodationsByUserIdService;

class GetAllAccommodationsByUserIdServiceTest extends TestCase
{
    private $getAllAccommodationsByUserIdService;
    public function setUp():void
    {
        parent::setUp();
        $this->getAllAccommodationsByUserIdService = $this->app->make(GetAllAccommodationsByUserIdService::class);
    }

    /**
     * @test
     */
    public function service_can_get_all_accommodations_by_user_id()
    {
        //arrange
        $user_id = 1;

        //act
        $result = $this->getAllAccommodationsByUserIdService->handle($user_id);

        //assert
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
        $this->assertCount(10,$result);

    }
}
