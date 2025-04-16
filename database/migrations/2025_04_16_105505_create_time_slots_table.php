<?php

use App\Domain\TimeSlots\Enums\StatusEnum;
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
        Schema::create('time_slots', function (Blueprint $table) {
            $table->id();
            $table->timestamp('start_date');
            $table->timestamp('end_date');
            $table->integer('duration');
            $table->double('price');
            $table->enum('status' , StatusEnum::allStatus());
            $table->foreignId('arena_id')->constrained('arenas')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('time_slots');
    }
};
