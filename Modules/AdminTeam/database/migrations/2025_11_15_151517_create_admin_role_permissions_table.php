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
        Schema::create('admin_role_permissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_role_id')->comment('Admin role ID');
            $table->unsignedBigInteger('permission_id')->comment('Permission ID');
            $table->boolean('allowed')->default(true)->comment('Indicates if the permission is allowed for the role');

            $table->unique(['admin_role_id', 'permission_id']);

            $table->foreign('admin_role_id')->references('id')->on('admin_roles')->onDelete('cascade');
            $table->foreign('permission_id')->references('id')->on('permission_lists')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_role_permissions');
    }
};
