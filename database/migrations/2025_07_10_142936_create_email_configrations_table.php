<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('email_configrations', function (Blueprint $table) {
            $table->id();
            $table->string('sender_name')->nullable();
            $table->string('mailer_name')->nullable();
            $table->string('host_email')->nullable();
            $table->string('mail_user_name')->nullable();
            $table->string('mail_port')->nullable();
            $table->string('mail_password')->nullable();
            $table->string('mail_encryption')->nullable();
            $table->string('mail_from_address')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('email_configrations');
    }
};
