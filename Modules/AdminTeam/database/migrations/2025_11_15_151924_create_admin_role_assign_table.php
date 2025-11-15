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
        Schema::create('admin_role_assign', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id')->comment('Admin user ID');
            $table->unsignedBigInteger('admin_role_id')->comment('Admin role ID');
            $table->string('assigned_by')->nullable()->comment('Assigned by user ID or name');
            $table->timestamp('assigned_at')->useCurrent()->comment('Assigned at timestamp');
            $table->string('status')->default('active')->comment('Status of the assignment (active/inactive)');

            $table->unique(['admin_id', 'admin_role_id']);

            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
            $table->foreign('admin_role_id')->references('id')->on('admin_roles')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop foreign keys first to avoid MySQL "cannot drop table referenced by a foreign key" errors
        if (Schema::hasTable('admin_role_assign')) {
            Schema::table('admin_role_assign', function (Blueprint $table) {
                if (Schema::hasColumn('admin_role_assign', 'admin_id')) {
                    $table->dropForeign(['admin_id']);
                }
                if (Schema::hasColumn('admin_role_assign', 'admin_role_id')) {
                    $table->dropForeign(['admin_role_id']);
                }
            });
        }

        Schema::dropIfExists('admin_role_assign');
    }
};
