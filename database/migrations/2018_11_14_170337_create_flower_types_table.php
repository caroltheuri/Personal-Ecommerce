<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlowerTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flower_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('flower_types_name');
            $table->timestamps();
        });
        DB::table('flower_types')->insert(
            array(
                ['flower_types_name' => 'Rose'],
                ['flower_types_name' => 'Tulips'],
                ['flower_types_name' => 'Lilies'],
                ['flower_types_name' => 'Narcissus'],
                ['flower_types_name' => 'Anemone'],
                ['flower_types_name' => 'Carnations'],
                ['flower_types_name' => 'Orchids'],
                ['flower_types_name' => 'Sunflower'],
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
        Schema::dropIfExists('flower_types');
    }
}
