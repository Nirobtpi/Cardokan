<?php

namespace App\Providers;

use App\Models\EmailConfigration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class MailServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        if (Schema::hasTable('email_configrations')) {
            $mail = EmailConfigration::first();
            if ($mail) {
                $config = [
                    'mailers' => [
                        'smtp' => [
                            'transport' => $mail->mailer_name,
                            'host' => $mail->host_email,
                            'port' => $mail->mail_port,
                            'encryption' => $mail->mail_encryption,
                            'username' => $mail->mail_user_name,
                            'password' => $mail->mail_password,
                            'timeout' => null,
                            'auth_mode' => null,
                        ],
                    ],
                    'from' => [
                        'address' => $mail->mail_from_address,
                        'name' => $mail->sender_name,
                    ],
                ];

                config(['mail.default' => $mail->mailer_name]);
                config(['mail.mailers.smtp' => $config['mailers']['smtp']]);
                config(['mail.from' => $config['from']]);
            }
        }
    }
}
