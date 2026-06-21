<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('daily_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->date('history_date');
            $table->integer('quiz_score')->default(0);
            $table->integer('activity_minutes')->nullable();
            $table->integer('activity_calories')->nullable();
            $table->timestamps();

            $table->index('history_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('daily_logs');
    }
};
