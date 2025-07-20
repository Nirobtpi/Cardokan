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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('blog_category_id')->constrained('blog_categories')->onDelete('cascade')->onUpdate('cascade');
            $table->string('title');
            $table->string('slug')->unique('slug');
            $table->string('image')->nullable();
            $table->longText('description')->nullable();
            $table->string('popular')->nullable()->default('off');
            $table->string('status')->nullable()->default('off');
            $table->string('tags')->nullable();
            $table->string('seo_title')->nullable();
            $table->string('seo_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
