<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTourBookingsTable extends Migration
{
    public function up()
    {
        Schema::create('tour_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('tour_id')->constrained()->onDelete('cascade');
            $table->foreignId('schedule_id')->constrained('tour_schedules')->onDelete('cascade');
            $table->string('full_name');
            $table->string('email');
            $table->string('contact');
            $table->integer('pax_count'); // number of people
            $table->decimal('total_price', 10, 2); // total computed price
            $table->enum('status', ['pending', 'approved', 'cancelled'])->default('pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tour_bookings');
    }
}
