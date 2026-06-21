<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('activity_type');
            $table->string('pace_intensity')->nullable();
            $table->integer('duration_minutes');
            $table->decimal('distance_km', 6, 2)->nullable();
            $table->integer('calories_burned')->nullable();
            $table->decimal('weight_kg', 5, 1)->nullable();
            $table->date('activity_date');
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index('activity_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
