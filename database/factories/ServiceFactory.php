<?php

namespace Database\Factories;

use App\Models\Application;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'slug' => $this->faker->slug,
            'application_origin_id' => Application::factory(),
            'application_destination_id' => Application::factory(),
            'endpoint_parameters' => [],
            'callback_parameters' => [],
        ];
    }
}
