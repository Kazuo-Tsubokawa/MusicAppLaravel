<?php

namespace Database\Factories;

use App\Models\Prefecture;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArtistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::inRandomOrder()->first(),
            'name' => $this->faker->word() . $this->faker->name(),
            'prefecture_id' => Prefecture::inRandomOrder()->first(),
            'introduction' => $this->faker->paragraph(),
            'image' => "2mf1Bnar2WUEQWX7zefjicbyzMTaz7VexCYLilUt.jpg"
        ];
    }
}
