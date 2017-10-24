<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQualitySystemInstancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quality_system_instances', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quality_system_id')->unsigned();
            $table->integer('component_owner_id')->unsigned();
            $table->string('url', 150);
            $table->integer('type');
            $table->string('username', 150)->nullable();
            $table->string('password', 150)->nullable();
            $table->boolean('verified')->default(0);
            $table->timestamps();
            $table->foreign('quality_system_id')->references('id')->on('quality_systems')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quality_system_instances');
    }
}
