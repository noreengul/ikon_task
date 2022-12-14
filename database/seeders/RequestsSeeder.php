<?php

namespace Database\Seeders;

use App\Models\UserInvitation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RequestsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserInvitation::insert([
            'invited_to'=>2,
            'user_id'=> 1,
            'is_accepted'=>0,
        ]);

        UserInvitation::insert([
            'invited_to'=>3,
            'user_id'=> 1,
            'is_accepted'=>0,
        ]);

        UserInvitation::insert([
            'invited_to'=>4,
            'user_id'=> 1,
            'is_accepted'=>0,
        ]);
    }
}
