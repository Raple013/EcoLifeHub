<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('daily_histories', function (Blueprint $table) {
            $table->integer('activity_minutes')->nullable()->after('quiz_score');
            $table->integer('activity_calories')->nullable()->after('activity_minutes');
        });
    }

    public function down(): void
    {
        Schema::table('daily_histories', function (Blueprint $table) {
            $table->dropColumn(['activity_minutes', 'activity_calories']);
        });
    }
};
