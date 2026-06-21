<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sdgs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('image')->nullable();
            $table->text('description');
            $table->text('importance');
            $table->string('target1');
            $table->string('target2');
            $table->string('target3');
            $table->string('action1');
            $table->string('action2');
            $table->string('action3');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sdgs');
    }
};
