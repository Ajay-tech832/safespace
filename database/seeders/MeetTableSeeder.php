<?php

namespace Database\Seeders;

use App\Models\Meet;
use Illuminate\Database\Seeder;

class MeetTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Meet::create([
                       'name'=>'meet at restuarent'
        ]);
    }
}
