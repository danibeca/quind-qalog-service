<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIssueTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issue_tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 20);
            $table->timestamps();
        });
        DB::table('issue_tags')->insert(
            array(
                array(
                    'name' => 'pitfall'),
                array(
                    'name' => 'misra'),
                array(
                    'name' => 'unused'),
                array(
                    'name' => 'brain-overload'),
                array(
                    'name' => 'clumsy'),
                array(
                    'name' => 'cert'),
                array(
                    'name' => 'cwe'),
                array(
                    'name' => 'convention'),
                array(
                    'name' => 'cross-browser'),
                array(
                    'name' => 'user-experience'),
                array(
                    'name' => 'owasp-a6'),
                array(
                    'name' => 'suspicious'),
                array(
                    'name' => 'error-handling'),
                array(
                    'name' => 'unpredictable'),
                array(
                    'name' => 'confusing'),
                array(
                    'name' => 'design'),
                array(
                    'name' => 'denial-of-service'),
                array(
                    'name' => 'leak'),
                array(
                    'name' => 'bad-practice'),
                array(
                    'name' => 'tests'),
                array(
                    'name' => 'java8'),
                array(
                    'name' => 'serialization'),
                array(
                    'name' => 'overflow'),
                array(
                    'name' => 'sans-top25-risky'),
                array(
                    'name' => 'performance'),
                array(
                    'name' => 'redundant'),
                array(
                    'name' => 'psr2'),
                array(
                    'name' => 'accessibility'),
                array(
                    'name' => 'html5'),
                array(
                    'name' => 'obsolete'),
                array(
                    'name' => 'multi-threading'),
                array(
                    'name' => 'junit'),
                array(
                    'name' => 'hibernate'),
                array(
                    'name' => 'injection'),
                array(
                    'name' => 'owasp-top10'),
                array(
                    'name' => 'sans-top25'),
                array(
                    'name' => 'sql'),
                array(
                    'name' => 'owasp-a1'),
                array(
                    'name' => 'owasp-a2'),
                array(
                    'name' => 'lock-in'),
                array(
                    'name' => 'finding')
            ));

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('issue_tags');
    }
}
