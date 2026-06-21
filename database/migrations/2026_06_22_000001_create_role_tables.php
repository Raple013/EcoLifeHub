<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('role', function (Blueprint $table) {
            $table->id('id_role');
            $table->string('nama_role', 25);
            $table->timestamps();
        });

        Schema::create('permission', function (Blueprint $table) {
            $table->id();
            $table->string('nama_permission', 50);
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });

        Schema::create('role_permission', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('permission_id');

            $table->foreign('role_id')->references('id_role')->on('role')->cascadeOnDelete();
            $table->foreign('permission_id')->references('id')->on('permission')->cascadeOnDelete();
            $table->primary(['role_id', 'permission_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('role_permission');
        Schema::dropIfExists('permission');
        Schema::dropIfExists('role');
    }
};
