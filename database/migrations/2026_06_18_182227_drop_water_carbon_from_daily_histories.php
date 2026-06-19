<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('daily_histories', function (Blueprint $table) {
            $table->dropColumn(['water_progress', 'water_target', 'carbon_result']);
        });
    }

    public function down(): void
    {
        Schema::table('daily_histories', function (Blueprint $table) {
            $table->integer('water_progress')->default(0);
            $table->integer('water_target')->default(8);
            $table->decimal('carbon_result', 8, 2)->default(0);
        });
    }
};
