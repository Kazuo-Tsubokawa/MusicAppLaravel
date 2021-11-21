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
            'file_name' => "lZvHIkqcT24NiLMfsKNx7iEZzf4FqkrY7UVUDdJZ.mp3",
            'description' => $this->faker->paragraph(),
            'image' => "icmRRWJ7M6wYt3av7CpbjWABDtCiTGlUAGKN0rpF.png"
        ];
    }
}
