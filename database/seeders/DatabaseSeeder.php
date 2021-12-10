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
            RecipientTableSeeder::class,
            ChatTableSeeder::class,
            ConnectionTableSeeder::class,
            MemberTableSeeder::class,
            MessageTableSeeder::class,
            NotificationTableSeeder::class,
            UserPlanTableSeeder::class,
            QuestionTableSeeder::class,
            AnswerTableSeeder::class,
            
        ]);

        // $this->call('UsersTableSeeder');
        

    }
}
