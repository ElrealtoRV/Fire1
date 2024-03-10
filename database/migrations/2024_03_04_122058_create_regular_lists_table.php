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
        Schema::create('regular_lists', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->string('age');
            $table->string('bdate');
            $table->string('email')->unique();
            $table->string('contnum')->unique();
            $table->string('idnum')->unique();
            $table->unsignedBigInteger('affiliation')->nullable();
            $table->foreign('affiliation')->references('id')->on('affiliation_lists');
            $table->string('dept');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('regular_lists');
    }
};
