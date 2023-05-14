<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVaccinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vaccines', function (Blueprint $table) {
            $table->bigIncrements('vaccine_id');
            $table->string('vaccine');
            $table->timestamps();
        });

        DB::table('vaccines')->insert(
            array(
                
                'vaccine' => 'Oxford–AstraZeneca',
                
            )
        );
        DB::table('vaccines')->insert(
            array(
                'vaccine' => 'Janssen',
                
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vaccines');
    }
}
