<?php

declare(strict_types=1);

namespace Tests\Feature\Services\Accommodation;

use Tests\TestCase;
use App\Models\Accommodation\Accommodation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\Accommodation\CreateAccommodationService;

class CreateAccommodationServiceTest extends TestCase
{
    private $createAccommodationService;
    public function setUp():void
    {
        parent::setUp();
        $this->createAccommodationService = $this->app->make(CreateAccommodationService::class);
    }

    /**
     * @test
     */
    public function service_can_create_a_new_accommodation()
    {
        //arrange
        $newAccommodationData = Accommodation::factory()->make()->toArray();

        //act
        $result = $this->createAccommodationService->handle($newAccommodationData);

        //assert
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
        $this->assertArrayHasKey('id', $result);
        $this->assertArrayHasKey('name', $result);
        $this->assertArrayHasKey('type', $result);
        $this->assertArrayHasKey('city', $result);
        $this->assertArrayHasKey('address', $result);
        $this->assertArrayHasKey('country', $result);
        $this->assertArrayHasKey('postal_code', $result);
        $this->assertArrayHasKey('max_guests', $result);
        $this->assertArrayHasKey('distribution', $result);
        $this->assertArrayHasKey('updated_at', $result);
    }
}
