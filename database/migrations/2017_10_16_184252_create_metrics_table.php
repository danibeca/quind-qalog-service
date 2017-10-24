    <?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMetricsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('metrics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 45);
            $table->string('code', 45);
            $table->timestamps();
        });

        DB::table('metrics')->insert(
            array(

                array(
                    'id'   => 3,
                    'name' => 'lines_of_code',
                    'code' => 'lines_of_code',
                ),

                array(
                    'id'   => 5,
                    'name' => 'Blocker bug',
                    'code' => 'blocker_bug',
                ),

                array(
                    'id'   => 6,
                    'name' => 'Critical bug',
                    'code' => 'critical_bug',
                ),

                array(
                    'id'   => 7,
                    'name' => 'Major bug',
                    'code' => 'major_bug',
                ),

                array(
                    'id'   => 8,
                    'name' => 'Minor bug',
                    'code' => 'minor_bug',
                ),

                array(
                    'id'   => 9,
                    'name' => 'Info bug',
                    'code' => 'info_bug',
                ),

                array(
                    'id'   => 10,
                    'name' => 'Blocker vulnerability',
                    'code' => 'blocker_vulnerability',
                ),

                array(
                    'id'   => 11,
                    'name' => 'Critical vulnerability',
                    'code' => 'critical_vulnerability',
                ),

                array(
                    'id'   => 12,
                    'name' => 'Major vulnerability',
                    'code' => 'major_vulnerability',
                ),

                array(
                    'id'   => 13,
                    'name' => 'Minor vulnerability',
                    'code' => 'minor_vulnerability',
                ),

                array(
                    'id'   => 14,
                    'name' => 'Info vulnerability',
                    'code' => 'info_vulnerability',
                ),

                array(
                    'id'   => 15,
                    'name' => 'Blocker code smell',
                    'code' => 'blocker_code_smell',
                ),

                array(
                    'id'   => 16,
                    'name' => 'Critical code smell',
                    'code' => 'critical_code_smell',
                ),

                array(
                    'id'   => 17,
                    'name' => 'Major code smell',
                    'code' => 'major_code_smell',
                ),

                array(
                    'id'   => 18,
                    'name' => 'Minor code smell',
                    'code' => 'minor_code_smell',
                ),

                array(
                    'id'   => 19,
                    'name' => 'Info code smell',
                    'code' => 'info_code_smell',
                ),

                array(
                    'id'   => 20,
                    'name' => 'Brain overload',
                    'code' => 'brain-overload',
                ),

                array(
                    'id'   => 21,
                    'name' => 'Bad practice',
                    'code' => 'bad-practice',
                ),

                array(
                    'id'   => 22,
                    'name' => 'Cert',
                    'code' => 'cert',
                ),

                array(
                    'id'   => 23,
                    'name' => 'Clumsy',
                    'code' => 'clumsy',
                ),

                array(
                    'id'   => 24,
                    'name' => 'Confusing',
                    'code' => 'confusing',
                ),

                array(
                    'id'   => 25,
                    'name' => 'Convention',
                    'code' => 'convention',
                ),

                array(
                    'id'   => 26,
                    'name' => 'Cwe',
                    'code' => 'cwe',
                ),

                array(
                    'id'   => 27,
                    'name' => 'Design',
                    'code' => 'design',
                ),

                array(
                    'id'   => 28,
                    'name' => 'Lock in',
                    'code' => 'lock-in',
                ),

                array(
                    'id'   => 29,
                    'name' => 'Misra',
                    'code' => 'misra',
                ),

                array(
                    'id'   => 30,
                    'name' => 'Owasp ',
                    'code' => 'owasp-',
                ),

                array(
                    'id'   => 31,
                    'name' => 'Pitfall',
                    'code' => 'pitfall',
                ),

                array(
                    'id'   => 32,
                    'name' => 'Sans top25 ',
                    'code' => 'sans-top25-',
                ),

                array(
                    'id'   => 33,
                    'name' => 'Security',
                    'code' => 'security',
                ),

                array(
                    'id'   => 34,
                    'name' => 'Suspicious',
                    'code' => 'suspicious',
                ),

                array(
                    'id'   => 35,
                    'name' => 'Unpredictable',
                    'code' => 'unpredictable',
                ),

                array(
                    'id'   => 36,
                    'name' => 'Unused',
                    'code' => 'unused',
                ),

                array(
                    'id'   => 37,
                    'name' => 'User experience',
                    'code' => 'user-experience',
                ),

                array(
                    'id'   => 38,
                    'name' => 'Coverage',
                    'code' => 'coverage',
                ),

                array(
                    'id'   => 39,
                    'name' => 'Duplicated blocks',
                    'code' => 'duplicated_blocks',
                ),
            )
        );

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('metrics');
    }
}
