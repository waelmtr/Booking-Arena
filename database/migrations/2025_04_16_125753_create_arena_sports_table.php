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
        Schema::create('arena_sports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('arena_id')->constrained('arenas')->cascadeOnDelete();
            $table->foreignId('sport_id')->constrained('sports')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arena_sports');
    }
};
