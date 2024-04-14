<?php

namespace Database\Factories;

use App\Models\MessageDepend;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class MessageDependFactory extends Factory
{
    protected $model = MessageDepend::class;
    
    public function definition(): array
    {
        return [
            'created_at'   => Carbon::now(),
            'updated_at'   => Carbon::now(),
            'chain_tenant' => $this->faker->word(),
            'chain_ref'    => $this->faker->word(),
        ];
    }
}
