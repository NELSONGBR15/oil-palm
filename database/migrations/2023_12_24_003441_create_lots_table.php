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
        Schema::create('lots', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('year_of_planting');
            $table->unsignedBigInteger('farm_id');
            $table->unsignedBigInteger('variety_id');
            $table->foreign('farm_id')->references('id')->on('farms');
            $table->foreign('variety_id')->references('id')->on('varieties');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lots');
    }
};
