<?php

namespace Database\Factories;

use App\Models\Artist;
use App\Models\Song;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class FollowFactory extends Factory
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
        ];
    }
}
