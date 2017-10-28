<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQualitySystemInstanceResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quality_system_instance_resources', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quality_system_instance_id')->unsigned();
            $table->string('key', 100)->nullable();
            $table->string('name', 150)->nullable();
            $table->timestamps();
            $table->foreign('quality_system_instance_id', 'qasin_qasin_resources_foreign')->references('id')->on('quality_system_instances');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quality_system_instance_resources');
    }
}
