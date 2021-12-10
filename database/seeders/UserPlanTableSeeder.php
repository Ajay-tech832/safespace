<?php

namespace Database\Seeders;

use App\Models\UserPlan;
use Illuminate\Database\Seeder;

class UserPlanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserPlan::create([
                          'transaction_id'=>'43online3245',
                          'payment_mode' =>'online',
        ]);
    }
}
