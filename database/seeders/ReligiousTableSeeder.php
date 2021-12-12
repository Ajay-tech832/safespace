<?php

namespace Database\Seeders;

use App\Models\Religious;
use Illuminate\Database\Seeder;

class ReligiousTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Religious::create([
                           'name' =>'religious name',
       ]);
    }
}
