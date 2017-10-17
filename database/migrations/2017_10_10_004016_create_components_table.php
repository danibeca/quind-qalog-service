<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComponentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('components', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tag_id')->unsigned();
            $table->string('key',100)->nullable();
            $table->string('app_code',100)->nullable();
            $table->string('username',100)->nullable();
            $table->string('password',100)->nullable();
            $table->string('api_server_url',250)->nullable();
            $table->integer('quality_system_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('tag_id')->references('id')->on('hierarchical_tags');
            $table->foreign('quality_system_id')->references('id')->on('quality_systems');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('components');
    }
}
