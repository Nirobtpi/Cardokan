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
        Schema::create('admin_roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->comment('Role name');
            $table->string('display_name')->comment('Display name for the role');
            $table->text('description')->nullable()->comment('Description of the role');
            $table->string('status')->default('active')->comment('Status of the role (active/inactive)');
            $table->boolean('is_system_role')->default(false)->comment('Indicates if the role is a default role');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_roles');
    }
};
