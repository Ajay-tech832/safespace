<?php

namespace Database\Seeders;

use App\Models\Looking;
use Illuminate\Database\Seeder;

class LookingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Looking::create([
                         'name'=>'looking for',
        ]);
    }
}
