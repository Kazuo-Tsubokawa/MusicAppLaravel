<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [ 'name' => 'ポップ'],
            [ 'name' => 'ロック'],
            [ 'name' => 'メタル'],
            [ 'name' => 'ジャズ'],
            [ 'name' => 'レゲエ'],
            [ 'name' => 'パンク'],
            [ 'name' => 'アカペラ'],
            [ 'name' => 'ギター弾き語り'],
            [ 'name' => 'ピアノ弾き語り'],
            [ 'name' => 'ピップポップ'],
            [ 'name' => 'ラップ'],
            [ 'name' => 'R&B'],
        ]);
    }
}
