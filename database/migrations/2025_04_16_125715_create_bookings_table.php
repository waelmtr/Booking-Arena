<?php

use App\Domain\Bookings\Enums\StatusEnum;
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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('time_slot_id');
            $table->foreignId('sport_id');
            $table->timestamp('expire_at')->nullable();
            $table->enum('status' , StatusEnum::allStatus())->default(StatusEnum::Pending->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
