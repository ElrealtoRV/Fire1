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
        Schema::create('record_lists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('type'); // Changing the data type
            $table->foreign('type')->references('id')->on('type_lists');
            $table->string('firename');
            $table->string('serial_number');
            $table->unsignedBigInteger('location'); // Changing the data type
            $table->foreign('location')->references('id')->on('location_lists');
            $table->date('maintenance_date');
            $table->date('expiration_date')->default(now());
            $table->unsignedBigInteger('finding'); // Changing the data type
            $table->foreign('finding')->references('id')->on('finding_lists')->nullable();
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('record_lists');
    }
};
