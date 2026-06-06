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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id')->constrained()->cascadeOnDelete();

            $table->string('name');
            $table->string('email');
            $table->string('phone');

            $table->date('booking_date');
            $table->time('start_time');
            $table->unsignedInteger('duration_hours');

            $table->decimal('price_per_hour', 8, 2);
            $table->decimal('service_fee', 8, 2)->default(1);
            $table->decimal('total_price', 8, 2);

            $table->string('status')->default('pending');

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
