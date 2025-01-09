<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Season;

class SeasonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Season::firstOrCreate(['name' => '春']);
        Season::firstOrCreate(['name' => '夏']);
        Season::firstOrCreate(['name' => '秋']);
        Season::firstOrCreate(['name' => '冬']);

    }
}
