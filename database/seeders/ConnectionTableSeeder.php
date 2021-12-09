<?php

namespace Database\Seeders;

use App\Models\Connection;
use Illuminate\Database\Seeder;

class ConnectionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Connection::create([
                        'user_id' => '1',
                        'recipient_id' => '1',
                        'status' =>'accept',
       ]);
    }
}
