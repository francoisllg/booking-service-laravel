<?php

declare(strict_types=1);

namespace Tests\Feature\Services\User;

use Tests\TestCase;
use App\Services\User\GetUserByIdService;

class GetUserByIdServiceTest extends TestCase
{
    private $getUserByIdService;
    public function setUp(): void
    {
        parent::setUp();
        $this->getUserByIdService = $this->app->make(GetUserByIdService::class);
    }

    /**
     * @test
     */
    public function service_can_get_a_user_by_id()
    {
        //arrange
        $userId = 1;

        //act
        $result = $this->getUserByIdService->handle($userId);

        //assert
        $this->assertIsArray($result);
    }
}
