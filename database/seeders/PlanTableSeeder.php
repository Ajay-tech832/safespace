<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Plan::create([
            'name' => 'Gold',
            'duration_amount' => '5',
            'duration_type' => 'month',
            'price' => '10000',
            'description' =>'Description',
            ]);
            
    }
}
