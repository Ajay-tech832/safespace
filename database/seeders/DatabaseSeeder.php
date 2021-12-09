<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([

            PlanTableSeeder::class,
            HobbiesTableSeeder::class,
            ChatTableSeeder::class,
            ConnectionTableSeeder::class,
            MemberTableSeeder::class,
            MessageTableSeeder::class,
            NotificationTableSeeder::class,
            UserPlanTableSeeder::class,
            
        ]);

        // $this->call('UsersTableSeeder');
        

    }
}
