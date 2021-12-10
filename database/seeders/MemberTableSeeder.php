<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Seeder;

class MemberTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Member::create([
                        'is_visible_profile'=>'yes',
                        'orientation'=>'orientation',
                        'relationship_status'=>'married',
                        'looking_for' =>'chat',
                        'is_pets' =>'yes',
                        'meet_at' => 'coffee shop',
                        'religious_views'=>'spiritual',
                        'children' =>'dont have',
                        'is_smoke' =>'no',
                        'is_drink' =>'no',
                        'is_canabis'=>'no',
                        'about' => 'about',
        ]);
    }
}
