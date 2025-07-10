<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use App\Models\EmailConfigration;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EmailConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $admin = Admin::where('email', 'admin@gmail.com')->first();
        EmailConfigration::create([
            "sender_name"=> "CarDokan",
            "mailer_name"=> "smtp",
            "host_email"=> "smtp.gmail.com",
            "mail_user_name"=> "test@gmail.com",
            "mail_port"=> "587",
            "mail_password"=> "abcdefgdh",
            "mail_encryption"=> "tls",
            "mail_from_address"=> "abc@gmail.com"
        ]);
    }
}
