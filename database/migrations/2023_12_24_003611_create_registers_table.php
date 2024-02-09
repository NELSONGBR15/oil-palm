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
        Schema::create('registers', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('line');
            $table->string('palm');
            $table->unsignedBigInteger('disease_id');
            $table->unsignedBigInteger('lot_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('disease_id')->references('id')->on('diseases');
            $table->foreign('lot_id')->references('id')->on('lots');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registers');
    }
};
