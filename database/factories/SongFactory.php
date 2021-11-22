<?php

namespace Database\Factories;

use App\Models\Artist;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class SongFactory extends Factory
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
            'category_id' => Category::inRandomOrder()->first(),
            'title' => $this->faker->word(),
            'file_name' => "wh0LMKfViOMnD6x2gEbbTHanEDMLyr6MwCybZ2Sz.mp3",
            'description' => $this->faker->paragraph(),
            'image' => "xYO23RlOEOEb0W71PGBLiEcc6JkseQ4Zv4bzpZhl.jpg"
        ];
    }
}
