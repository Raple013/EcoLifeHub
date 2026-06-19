<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('activity_logs', function (Blueprint $table) {
            $table->string('pace_intensity')->nullable()->after('activity_type');
            $table->decimal('weight_kg', 5, 1)->nullable()->after('calories_burned');
        });
    }

    public function down(): void
    {
        Schema::table('activity_logs', function (Blueprint $table) {
            $table->dropColumn(['pace_intensity', 'weight_kg']);
        });
    }
};
