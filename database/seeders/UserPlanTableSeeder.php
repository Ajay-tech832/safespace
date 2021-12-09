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
                          'user_id' =>'1',
                          'plan_id' =>'1',
                          'transaction_id'=>'43online3245',
                          'payment_mode' =>'online',
        ]);
    }
}
