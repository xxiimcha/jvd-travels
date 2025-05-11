<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTourSchedulesTable extends Migration
{
    public function up()
    {
        Schema::create('tour_schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('api_tour_id');  // Reference to API source
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('tour_type'); // Local / International / Solo / Group
            $table->integer('duration_days');
            $table->integer('duration_nights');
            $table->decimal('price', 10, 2);
            $table->string('price_basis')->nullable(); // optional future use
            $table->integer('capacity');
            $table->string('brochure')->nullable();
            $table->date('schedule_date');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tour_schedules');
    }
}
