<?php

namespace Database\Factories;

use App\Models\Collection;
use App\Models\Mapping;
use App\Support\Faker\Json;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Mapping>
 */
class MappingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'source_data' => $this->faker->json(denies: [Json::OBJECT]),
            'mapped_data' => $this->faker->jsonVariety(),
            'collection_id' => $this->faker->optional(0.7)->randomElement([Collection::factory()]),
        ];
    }
}
