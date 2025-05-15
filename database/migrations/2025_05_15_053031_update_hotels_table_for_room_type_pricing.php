<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateHotelsTableForRoomTypePricing extends Migration
{
    public function up()
    {
        Schema::table('hotels', function (Blueprint $table) {
            // Add new JSON column to store room types and prices
            $table->json('room_type_pricing')->nullable();

            // Optional: Remove old fixed room_type and price columns
            $table->dropColumn(['room_type', 'price']);
        });
    }

    public function down()
    {
        Schema::table('hotels', function (Blueprint $table) {
            // Rollback: re-add old columns
            $table->string('room_type')->nullable();
            $table->decimal('price', 10, 2)->nullable();

            $table->dropColumn('room_type_pricing');
        });
    }
}
