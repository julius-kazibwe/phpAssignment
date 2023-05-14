<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCentersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('centers', function (Blueprint $table) {
            $table->bigIncrements('center_id');
            $table->string('center_name');
            $table->string('location');
            $table->unsignedBigInteger('vaccine_id');
            $table->foreign('vaccine_id')->references('vaccine_id')->on('vaccines')->onDelete('cascade');

            //$table->primary('doctor_id');
        });

        // adding dummy entries
        DB::table('centers')->insert(
            array(
                'center_name' => 'Mulago Hospital',
                'location' => 'Mulago, Kampala',
                'vaccine_id' => '1',
            )
        );
        DB::table('centers')->insert(
            array(
                'center_name' => 'Munyonyo general Hospital',
                'location' => 'Munyonyo, Kampala',
                'vaccine_id' => '2',
            )
        );

        DB::table('centers')->insert(
            array(
                'center_name' => 'Case Hospital',
                'location' => 'Nakasero, Kampala',
                'vaccine_id' => '1',
            )
        );
        

    }

    
    public function down()
    {
        Schema::dropIfExists('centers');
    }
}