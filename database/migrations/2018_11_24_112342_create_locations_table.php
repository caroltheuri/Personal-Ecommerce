<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('location_name');
            $table->timestamps();
        });
        DB::table('locations')->insert(
            array(
                ['location_name' => 'New York'],
                ['location_name' => 'UK'],
                ['location_name' => 'Beijing'],
                ['location_name' => 'Nairobi'],
                ['location_name' => 'Brisbane'],
                ['location_name' => 'Ireland'],
                ['location_name' => 'Netherlands'],
                ['location_name' => 'Scotland'],
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
        Schema::dropIfExists('locations');
    }
}
