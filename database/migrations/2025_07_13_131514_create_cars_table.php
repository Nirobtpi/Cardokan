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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('name');
            $table->string('slug')->unique();

            $table->foreignId('brand_id')->constrained('car_brands')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('country_id')->constrained('countries')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('city_id')->constrained('cities')->onDelete('cascade')->onUpdate('cascade');
            // $table->foreignId('feature_id')->constrained('features')->onDelete('cascade')->onUpdate('cascade');

            $table->string('rent_period')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->decimal('offer_price', 10, 2)->nullable();
            $table->longText('description')->nullable();
            $table->string('seller_type')->nullable();
            $table->string('body_type')->nullable();
            $table->string('engine_size')->nullable();

            $table->string('drive')->nullable();
            $table->string('interior_color')->nullable();
            $table->string('exterior_color')->nullable();
            $table->string('year')->nullable();
            $table->string('mileage')->nullable();
            $table->tinyInteger('total_owner')->nullable();

            $table->string('purpose')->nullable();
            $table->string('fuel_type')->nullable();
            $table->string('transmission')->nullable();
            $table->string('car_model')->nullable();
            $table->integer('is_approve')->default(0);
            $table->string('image')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
