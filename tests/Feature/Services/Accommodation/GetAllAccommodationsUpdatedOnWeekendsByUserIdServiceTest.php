<?php

declare(strict_types=1);

namespace Tests\Feature\Services\Accommodation;

use Tests\TestCase;
use App\Services\Accommodation\GetAllAccommodationsUpdatedOnWeekendsByUserIdService;

class GetAllAccommodationsUpdatedOnWeekendsByUserIdServiceTest extends TestCase
{

    private $getAllAccommodationsUpdatedOnWeekendsByUserIdService;
    public function setUp(): void
    {
        parent::setUp();
        $this->getAllAccommodationsUpdatedOnWeekendsByUserIdService = $this->app->make(GetAllAccommodationsUpdatedOnWeekendsByUserIdService::class);
    }

    /**
     * @test
     */
    public function service_can_get_all_accommodations_updated_on_weekends_by_user_id()
    {
        //arrange
        $user_id = 1;

        //act
        $result = $this->getAllAccommodationsUpdatedOnWeekendsByUserIdService->handle($user_id);

        //assert
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
        $this->assertCount(3, $result);

    }
}
