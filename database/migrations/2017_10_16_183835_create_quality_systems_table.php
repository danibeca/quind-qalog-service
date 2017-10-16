<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQualitySystemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quality_systems', function (Blueprint $table) {
            $table->increments('id');
            $table->string('wrapper_class', 100);
            $table->timestamps();
        });

        DB::table('quality_systems')->insert(
            array(
                array(
                    'id' => 1,
                ),
                array(
                    'id' => 2,
                )
            ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quality_systems');
    }
}
