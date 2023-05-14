<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTreatmentRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('treatment_records', function (Blueprint $table) {
            $table->bigIncrements('record_id');
            $table->unsignedBigInteger('center_id');
            $table->unsignedBigInteger('patient_id');
            $table->string('fullname');
            $table->string('nin');
            $table->string('date');
            $table->string('vaccine');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('treatment_records');
    }
}