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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->string('age');
            $table->string('bdate');
            $table->string('email')->unique();
            $table->string('contnum')->unique();
            $table->string('idnum')->unique();
            $table->string('position');
            $table->string('office');
            $table->string('password');
            $table->tinyInteger('status')->default(0); // Assuming 0 means inactive and 1 means active
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
