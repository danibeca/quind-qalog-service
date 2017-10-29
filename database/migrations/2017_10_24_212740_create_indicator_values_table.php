

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndicatorValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indicator_values', function (Blueprint $table) {
            $table->integer('component_id')->unsigned();
            $table->integer('indicator_id')->unsigned();
            $table->double('value');
            $table->timestamps();

            $table->index(['component_id','indicator_id']);
            $table->foreign('component_id', 'fk_indicator_component')->references('id')->on('components')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('indicator_values');
    }
}
