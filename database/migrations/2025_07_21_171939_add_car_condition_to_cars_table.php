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
        Schema::table('cars', function (Blueprint $table) {
            $table->string('car_condition')->nullable()->after('image');
            $table->string('popular')->nullable()->after('car_condition');
            $table->string('feature')->nullable()->after('popular');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            if(Schema::hasColumn('cars','car_condition')){
                $table->dropColumn('car_condition');
            }
            if(Schema::hasColumn('cars','popular')){
                $table->dropColumn('popular');
            }
            if(Schema::hasColumn('cars','feature')){
                $table->dropColumn('feature');
            }

        });
    }
};
