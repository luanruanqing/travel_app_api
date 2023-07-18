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
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('travel_id')->nullable();
            $table->foreign('travel_id')->references('id')->on('travels')->onDelete('cascade');
            $table->unsignedBigInteger('hotel_id')->nullable();
            $table->foreign('hotel_id')->references('id')->on('hotels')->onDelete('cascade');
            $table->unsignedBigInteger('room_id')->nullable();
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
            $table->unsignedBigInteger('flight_id')->nullable();
            $table->foreign('flight_id')->references('id')->on('flights')->onDelete('cascade');
            $table->string("start_date");
            $table->string("guest_name");
            $table->string("guest_email");
            $table->string("end_date");
            $table->string("guest");
            $table->string("total_amount");
            $table->string("room_quality");
            $table->string("payment_method");
            $table->string("card_name")->nullable();
            $table->string("card_number")->nullable();
            $table->string("card_cvv")->nullable();
            $table->string("card_expiration")->nullable();
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
