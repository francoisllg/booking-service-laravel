<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Api\V1\Accommodation;

use Tests\TestCase;
use App\Models\Accommodation\Accommodation;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AccommodationControllerTest extends TestCase
{

    /**
     * @test
     */
    public function user_can_create_a_new_accommodation()
    {
        //arrange
        $userId = 1;
        $newAccommodationData = Accommodation::factory()->make()->toArray();
        $newAccommodationData['trade_name'] = $newAccommodationData['name'];
        unset($newAccommodationData['name']);

        //act
        $result = $this->postJson("api/v1/user/{$userId}/accommodations", $newAccommodationData);

        //assert
        $result->assertStatus(201);
        $result->assertJsonStructure([
            'id',
            'trade_name',
            'type',
            'max_guests',
            'city',
            'address',
            'country',
            'postal_code',
            'distribution',
            'updated_at',
        ]);
    }

    /**
     * @test
     */
    public function user_can_create_a_new_accommodation_with_the_data_from_the_challenge_readme()
    {
        //arrange
        $userId = 1;
        $newAccommodationData = [
            "trade_name" => "Lujoso apartamento en la playa",
            "type" => "FLAT",
            "distribution" => '{
                "living_rooms": 1 ,
                "bedrooms": 2 ,
                "beds": 3
            }',
            "max_guests" => 3
        ];

        //act
        $result = $this->postJson("api/v1/user/{$userId}/accommodations", $newAccommodationData);

        //assert
        $result->assertStatus(201);
        $result->assertJsonStructure([
            'id',
            'trade_name',
            'type',
            'max_guests',
            'distribution',
            'updated_at',
        ]);
    }

    /**
     * @test
     */
    public function user_cannot_create_an_accommodation_if_the_validation_fails()
    {
        //arrange
        $userId = 1;
        $newAccommodationData = Accommodation::factory()->make([
            'name' => '',
            'type' => 'INVALID_TYPE',
        ])->toArray();

        //act
        $result = $this->postJson("api/v1/user/{$userId}/accommodations", $newAccommodationData);

        //assert
        $result->assertStatus(400);
    }
    /**
     * @test
     */
    public function user_cannot_create_an_accommodation_if_the_max_guests_exceeds_the_number_of_beds()
    {
        //arrange
        $userId = 1;
        $newAccommodationData = [
            "trade_name" => "Lujoso apartamento en la playa",
            "type" => "FLAT",
            "distribution" => '{
                "living_rooms": 1 ,
                "bedrooms": 2 ,
                "beds": 2
            }',
            "max_guests" => 3
        ];

        //act
        $result = $this->postJson("api/v1/user/{$userId}/accommodations", $newAccommodationData);

        //assert
        $result->assertStatus(400);
    }

    /**
     * @test
     */
    public function user_can_get_all_accommodations_updated_on_weekends_by_user_id()
    {
        //arrange
        $userId = 1;

        //act
        $result = $this->get("api/v1/user/{$userId}/accommodations");

        //assert
        $result->assertStatus(200);
        $this->assertCount(3, $result->json());
    }

    /**
     * @test
     */
    public function user_cannot_get_all_accommodations_updated_on_weekends_by_user_id_if_the_user_does_not_exist()
    {
        //arrange
        $userId = 'vddj';

        //act
        $result = $this->get("api/v1/user/{$userId}/accommodations");

        //assert
        $result->assertStatus(400);
    }

    /**
     * @test
     */
    public function user_can_update_an_accommodation_of_its_own()
    {
        //arrange
        $userId          = 275;
        $accommodationId = 1;
        $updatedAccommodationData = [
            'id' => 1,
            'name' => 'Updated name',
            'type' => 'HOUSE',
            'city' => 'Updated city',
            'address' => 'Updated address',
            'country' => 'Updated country',
            'postal_code' => 'Updated postal code',
            'max_guests' => 2,
        ];

        //act
        $result = $this->put("api/v1/user/{$userId}/accommodations/{$accommodationId}", $updatedAccommodationData);

        //assert
        $result->assertStatus(200);
        $this->assertEquals($result['updated_at'], date('Y-m-d'));
        $result->assertJsonStructure([
            'id',
            'trade_name',
            'type',
            'max_guests',
            'city',
            'address',
            'country',
            'postal_code',
            'distribution',
            'updated_at',
        ]);
    }
}
