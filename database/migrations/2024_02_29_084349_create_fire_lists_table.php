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
        Schema::create('fire_lists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('type'); // Changing the data type
            $table->foreign('type')->references('id')->on('type_lists');
            $table->string('firename');
            $table->string('serial_number');
            $table->unsignedBigInteger('building');
            $table->unsignedBigInteger('floor');
            $table->unsignedBigInteger('room');
            $table->foreign('building')->references('id')->on('location_lists');
            $table->foreign('floor')->references('id')->on('location_lists');
            $table->foreign('room')->references('id')->on('location_lists');
            $table->date('installation_date');
            $table->date('expiration_date')->default(now());
            $table->text('description')->nullable();
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fire_lists');
    }
};
