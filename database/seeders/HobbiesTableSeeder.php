<?php

namespace Database\Seeders;

use App\Models\Hobbie;
use Illuminate\Database\Seeder;

class HobbiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Hobbie::create([
            'name' => 'Reading',
            'icon' => 'path of icon',
        ]);
    }
}
