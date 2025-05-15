<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateHotelsTableAddRoomTypePricing extends Migration
{
    public function up()
    {
        Schema::table('hotels', function (Blueprint $table) {
            $table->json('room_type_pricing')->nullable();

            // Only if not already removed
            if (Schema::hasColumn('hotels', 'room_type')) {
                $table->dropColumn('room_type');
            }
            if (Schema::hasColumn('hotels', 'price')) {
                $table->dropColumn('price');
            }
        });
    }

    public function down()
    {
        Schema::table('hotels', function (Blueprint $table) {
            $table->string('room_type')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->dropColumn('room_type_pricing');
        });
    }
}
