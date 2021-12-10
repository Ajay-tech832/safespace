<?php

namespace Database\Seeders;

use App\Models\Recipient;
use Illuminate\Database\Seeder;

class RecipientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Recipient::create([
                           'name'=>'name of recipient',
        ]);
    }
}
