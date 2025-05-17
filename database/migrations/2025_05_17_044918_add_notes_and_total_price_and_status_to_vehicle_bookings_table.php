<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('vehicle_bookings', function (Blueprint $table) {
            $table->text('notes')->nullable();
            $table->decimal('total_price', 12, 2)->default(0);
            $table->string('status')->default('Pending');
        });
    }

    public function down()
    {
        Schema::table('vehicle_bookings', function (Blueprint $table) {
            $table->dropColumn(['notes', 'total_price', 'status']);
        });
    }

};
