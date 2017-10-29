<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExternalMetricValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('external_metric_values', function (Blueprint $table) {
            $table->integer('component_id')->unsigned();
            $table->integer('external_metric_id')->unsigned();
            $table->double('value');
            $table->timestamps();

            $table->index(['component_id','external_metric_id']);
            $table->foreign('component_id', 'fk_external_metric_component')->references('id')->on('components')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('external_metric_values');
    }
}
