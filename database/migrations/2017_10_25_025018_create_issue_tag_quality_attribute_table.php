<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIssueTagQualityAttributeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issue_tag_quality_attribute', function (Blueprint $table) {
            $table->integer('quality_attribute_id')->unsigned();
            $table->integer('issue_tag_id')->unsigned();

            $table->foreign('quality_attribute_id')->references('id')->on('quality_attributes')->onDelete('cascade');
            $table->foreign('issue_tag_id')->references('id')->on('issue_tags')->onDelete('cascade');

            $table->primary(['quality_attribute_id', 'issue_tag_id'], 'issue_tag_attribute_id_primary');

        });
        DB::table('issue_tag_quality_attribute')->insert(
            array(
                array(
                    'quality_attribute_id' => 1,
                    'issue_tag_id'         => 1
                ),
                array(
                    'quality_attribute_id' => 2,
                    'issue_tag_id'         => 1
                ),
                array(
                    'quality_attribute_id' => 1,
                    'issue_tag_id'         => 3
                ),
                array(
                    'quality_attribute_id' => 1,
                    'issue_tag_id'         => 4
                ),
                array(
                    'quality_attribute_id' => 1,
                    'issue_tag_id'         => 5
                ),
                array(
                    'quality_attribute_id' => 3,
                    'issue_tag_id'         => 7
                ),
                array(
                    'quality_attribute_id' => 5,
                    'issue_tag_id'         => 10
                ),
                array(
                    'quality_attribute_id' => 3,
                    'issue_tag_id'         => 11
                ),
                array(
                    'quality_attribute_id' => 2,
                    'issue_tag_id'         => 12
                ),
                array(
                    'quality_attribute_id' => 2,
                    'issue_tag_id'         => 13
                ),
                array(
                    'quality_attribute_id' => 2,
                    'issue_tag_id'         => 14
                ),
                array(
                    'quality_attribute_id' => 3,
                    'issue_tag_id'         => 17
                ),
                array(
                    'quality_attribute_id' => 3,
                    'issue_tag_id'         => 18
                ),
                array(
                    'quality_attribute_id' => 2,
                    'issue_tag_id'         => 23
                ),
                array(
                    'quality_attribute_id' => 3,
                    'issue_tag_id'         => 24
                ),
                array(
                    'quality_attribute_id' => 4,
                    'issue_tag_id'         => 25
                ),
                array(
                    'quality_attribute_id' => 5,
                    'issue_tag_id'         => 28
                ),
                array(
                    'quality_attribute_id' => 1,
                    'issue_tag_id'         => 29
                ),
                array(
                    'quality_attribute_id' => 1,
                    'issue_tag_id'         => 30
                ),
                array(
                    'quality_attribute_id' => 2,
                    'issue_tag_id'         => 30
                ),
                array(
                    'quality_attribute_id' => 4,
                    'issue_tag_id'         => 31
                ),
                array(
                    'quality_attribute_id' => 1,
                    'issue_tag_id'         => 34
                ),
                array(
                    'quality_attribute_id' => 3,
                    'issue_tag_id'         => 35
                ),
                array(
                    'quality_attribute_id' => 3,
                    'issue_tag_id'         => 36
                ),
                array(
                    'quality_attribute_id' => 1,
                    'issue_tag_id'         => 38
                ),
                array(
                    'quality_attribute_id' => 1,
                    'issue_tag_id'         => 39
                ),
            ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('issue_tag_quality_attribute');
    }
}
