<?php

namespace Database\Factories;

use App\Models\Point;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PointFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'pointable_type' => 'App\Models\User',
            'pointable_id' => '2',
            'register' => $this->faker->dateTime(),
        ];

    }
}
