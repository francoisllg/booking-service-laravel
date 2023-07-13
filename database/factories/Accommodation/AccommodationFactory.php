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
            'distribution' => json_encode([
                'living_rooms' => $this->faker->numberBetween(1, 10),
                'bedrooms'     => $this->faker->numberBetween(1, 10),
                'beds'         => $this->faker->numberBetween(5, 10),
            ]),
            'max_guests'   => $this->faker->numberBetween(1, 5),
            'city'         => $this->faker->city(),
            'address'      => $this->faker->address(),
            'country'      => $this->faker->country(),
            'postal_code'  => $this->faker->postcode(),

        ];
    }
}
