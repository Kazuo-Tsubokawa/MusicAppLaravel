<?php

namespace Database\Factories;

use App\Models\Artist;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'artist_id' => Artist::inRandomOrder()->first(),
            'user_id' => User::inRandomOrder()->first(),
            'name' => $this->faker->word() . $this->faker->name(),
            'description' => $this->faker->paragraph(),
        ];
    }
}
