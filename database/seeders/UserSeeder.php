<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            'name' =>'Rachel Test',
            'email'=>'rachel_test@gmail.com',
            'password'=>Hash::make('test123')
        ]);
        User::insert([
            'name' =>'Alex',
            'email'=>'alex_test@gmail.com',
            'password'=>Hash::make('test123')
        ]);
        User::insert([
            'name' =>'Ali test',
            'email'=>'ali_test@gmail.com',
            'password'=>Hash::make('test123')
        ]);
        User::insert([
            'name' =>'Ron test',
            'email'=>'ron_test@gmail.com',
            'password'=>Hash::make('test123')
        ]);
    }
}
