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
        Schema::create('request_lists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('type'); // Changing the data type
            $table->foreign('type')->references('id')->on('type_lists');
            $table->string('firename');
            $table->string('serial_number');
            $table->unsignedBigInteger('location'); // Changing the data type
            $table->foreign('location')->references('id')->on('location_lists');
            $table->unsignedBigInteger('request'); // Changing the data type
            $table->foreign('request')->references('id')->on('requests');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_lists');
    }
};
