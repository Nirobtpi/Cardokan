<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'name'=>'Admin',
            'email'=>'admin@gmail.com',
            'password'=>Hash::make('1234'),
            'designation'=>'Admin',
            'phone'=>'01700000000',
            'photo'=>'',
            'facebook'=>'www.facebook.com',
            'linkedin'=>'www.linkedin.com',
            'twitter'=>'www.twitter.com',
            'instagram'=>'www.instagram.com',
            'about_me'=>'I am the admin of this application.',
            'status'=>'active',
            'remember_token'=>null,
        ]);
    }
}
