<?php

namespace Database\Seeders;

use App\Models\Chat;
use Illuminate\Database\Seeder;

class ChatTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Chat::create([
            'user_id' => '1',
            'recipient_id' => '1',
            'chat_topic' =>'chat topic description',
        ]);
    }
}
