<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleBookingsTable extends Migration
{
    public function up()
    {
        Schema::create('vehicle_bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('vehicle_id');
            $table->dateTime('pickup_date');
            $table->dateTime('return_date');
            $table->string('origin');
            $table->string('destination');
            $table->string('full_name');
            $table->string('email');
            $table->string('phone', 20);
            $table->string('address');
            $table->timestamps();

            // Foreign key constraint (optional if `users` table exists)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('vehicle_bookings');
    }
}
