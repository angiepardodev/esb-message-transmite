<?php

namespace Database\Factories;

use App\Core\Signal;
use App\Models\Service;
use App\Models\Message;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class MessageFactory extends Factory
{
    protected $model = Message::class;
    
    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'service'    => Service::factory(),
            'sequence'   => $this->faker->word(),
            'signal'     => function () {
                $raw = $this->faker->jsonObject();
                return new Signal(
                    $raw, json_decode($raw, true), 'json'
                );
            },
        ];
    }
}
