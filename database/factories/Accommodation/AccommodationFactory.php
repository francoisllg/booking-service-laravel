<?php

declare(strict_types=1);

namespace Database\Factories\Accommodation;

use Illuminate\Database\Eloquent\Factories\Factory;

class AccommodationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name'         => $this->faker->name(),
            'type'         => $this->faker->randomElement(['HOUSE', 'FLAT', 'VILLA']),
            'city'         => $this->faker->city(),
            'address'      => $this->faker->address(),
            'country'      => $this->faker->country(),
            'postal_code'  => $this->faker->postcode(),
            'max_guests'   => $this->faker->numberBetween(1, 10),
            'distribution' => json_encode([
                'living_rooms' => $this->faker->numberBetween(1, 10),
                'bedrooms'     => ["{'beds' => 1},{'beds'=>1}"],
            ]),

        ];
    }
}
