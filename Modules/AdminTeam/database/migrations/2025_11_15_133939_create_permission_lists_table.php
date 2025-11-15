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
        Schema::create('permission_lists', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->comment('Permission name');
            $table->string('display_name')->comment('Display name for the permission');
            $table->string('module')->comment('Module associated with the permission');
            $table->text('description')->nullable()->comment('Description of the permission');
            $table->tinyInteger('group')->default(false)->comment('Group of the permission');
            $table->unsignedBigInteger('parent_id')->nullable()->comment('Parent permission ID for hierarchical permissions');
            $table->string('status')->default('active')->comment('Status of the permission (active/inactive)');

            $table->foreign('parent_id')->references('id')->on('permission_lists')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permission_lists');
    }
};
