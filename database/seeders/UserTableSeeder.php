<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
                      'full_name'=>'Ajay kushwaha',
                      'first_name' =>'Ajay',
                      'last_name'=>'kushwaha',
                      'email'=> 'ajay@gmail.com',
                      'mobile' =>'8957388096',
        ]);
    }
}
