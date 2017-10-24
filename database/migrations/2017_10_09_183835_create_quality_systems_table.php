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
            $table->string('name', 50);
            $table->string('wrapper_class', 100);
            $table->boolean('active');
            $table->timestamps();
        });

        DB::table('quality_systems')->insert(
            array(
                array(
                    'id' => 1,
                    'name' => 'SonarQube 6',
                    'wrapper_class' => 'App\Models\QualitySystem\Wrapper\Sonar63Wrapper',
                    'active' => true
                ),
                array(
                    'id' => 2,
                    'name' => 'SonarQube 6.2',
                    'wrapper_class' => 'App\Models\QualitySystem\Wrapper\Sonar62Wrapper',
                    'active' => false
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
