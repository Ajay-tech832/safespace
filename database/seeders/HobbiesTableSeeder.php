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
                'name' => 'Singing',
                'icon' => 'path of icon'
            ]);

            Hobbie::create([
                'name' => 'Movies',
                'icon' => 'path of icon'

            ]);

            Hobbie::create([
                'name' => 'Football',
                'icon' => 'path of icon'
            ]);
            
            Hobbie::create([
                'name' => 'Gaming',
                'icon' => 'path of icon'
            ]);

            Hobbie::create([
                'name' => 'painting',
                'icon' => 'path of icon'
            ]);

            Hobbie::create([
                'name' => 'Traveling',
                'icon' => 'path of icon'
            ]);

            Hobbie::create([
                'name' => 'Reading',
                'icon' => 'path of icon'
            ]);

            Hobbie::create([
                'name' => 'Food',
                'icon' => 'path of icon'
            ]);

            Hobbie::create([
                'name' => 'Driving',
                'icon' => 'path of icon'
            ]);

            Hobbie::create([
                'name' => 'Mountain Biking',
                'icon' => 'path of icon'
            ]);

            Hobbie::create([
                'name' => 'Climb',
                'icon' => 'path of icon'
            ]);

       
    }
}
