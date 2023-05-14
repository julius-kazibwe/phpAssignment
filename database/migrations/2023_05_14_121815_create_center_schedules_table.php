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
        Schema::create('center_schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('center_id');
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->timestamps();
            $table->foreign('center_id')->references('center_id')->on('centers')->onDelete('cascade');

        });

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctor_schedules');
    }
};



