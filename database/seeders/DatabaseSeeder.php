<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Prefecture;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(20)->create();
        $this->call([
            CategorySeeder::class,
            PrefectureSeeder::class,
        ]);
        \App\Models\Artist::factory(5)->create();
        \App\Models\Song::factory(20)->create();
        \App\Models\Like::factory(30)->create();
        \App\Models\Follow::factory(10)->create();
        \App\Models\Member::factory(15)->create();

    }
}
