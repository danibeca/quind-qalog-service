<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLastRunClientToComponentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('components', function (Blueprint $table) {
            $table->dateTime('last_run_client');
            $table->dateTime('last_run_quind');
            $table->boolean('run_client')->default(true);
            $table->boolean('run_quind')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('components', function (Blueprint $table) {
            $table->dropColumn(['last_run_client', 'last_run_quind', 'run_client', 'run_quind']);

        });
    }
}
