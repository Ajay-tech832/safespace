<?php

namespace Database\Seeders;

use App\Models\Orientation;
use Illuminate\Database\Seeder;

class OrientationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Orientation::create([
                              'name'=>'about orientation',
        ]);
    }
}
