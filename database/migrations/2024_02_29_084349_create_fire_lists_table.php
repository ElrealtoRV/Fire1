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
            $table->string('type');
            $table->string('firename');
            $table->string('serial_number');
            $table->string('location');
            $table->date('installation_date');
            $table->date('expiration_date')->default(now());
            $table->text('inspection_findings')->nullable();
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
