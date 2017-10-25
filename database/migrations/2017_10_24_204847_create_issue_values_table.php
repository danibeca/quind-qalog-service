<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIssueValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issue_values', function (Blueprint $table) {
            $table->integer('component_id')->unsigned();
            $table->string('rule', 200)->nullable();
            $table->string('severity', 20)->nullable();
            $table->string('status', 20)->nullable();
            $table->mediumText('message')->nullable();
            $table->double('effort')->nullable();
            $table->string('effortText',25)->nullable();
            $table->string('debt', 20)->nullable();
            $table->string('tags', 200)->nullable();
            $table->string('type', 200)->nullable();
            $table->date('creationDate')->nullable();
            $table->date('updateDate')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('issue_values');
    }
}
