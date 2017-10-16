<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndicatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indicators', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tmpname', 100);
            $table->string('code', 45);
            $table->integer('level');
            $table->mediumText('calculation_rule');
            $table->mediumText('calculation_data');
            $table->integer('lr_name')->nullable();
            $table->timestamps();
        });

        DB::table('indicators')->insert(

            array(

                array(
                    'id'               => 1,
                    'tmpname'          => 'Number Line of Code',
                    'code'             => 'nloc',
                    'level'            => 1,
                    'calculation_rule' => '{ "var" : ["@met_lines_of_code"] }',
                    'calculation_data' => '{ "@met_lines_of_code" : "@met_lines_of_code.value" }',
                    'lr_name'          => null,
                ),

                array(
                    'id'               => 2,
                    'tmpname'          => 'Indicador de Complejidad funcional',
                    'code'             => 'function_complexity',
                    'level'            => 1,
                    'calculation_rule' => '{ "var" : ["@met_function_complexity"] }',
                    'calculation_data' => '{ "@met_function_complexity" : "@met_function_complexity.value" }',
                    'lr_name'          => null,
                ),

                array(
                    'id'               => 3,
                    'tmpname'          => 'Indicador de lineas duplicadas',
                    'code'             => 'duplicated_lines',
                    'level'            => 1,
                    'calculation_rule' => '{ "var" : ["@met_duplicated_lines"] }',
                    'calculation_data' => '{ "@met_duplicated_lines" : "@met_duplicated_lines.value" }',
                    'lr_name'          => null,
                ),

                array(
                    'id'               => 4,
                    'tmpname'          => 'Indicador de deuda tecnica',
                    'code'             => 'technical_debt',
                    'level'            => 1,
                    'calculation_rule' => '{ "var" : ["@met_technical_debt"] }',
                    'calculation_data' => '{ "@met_technical_debt" : "@met_technical_debt.value" }',
                    'lr_name'          => null,
                ),

                array(
                    'id'               => 5,
                    'tmpname'          => 'Blocker bug',
                    'code'             => 'blocker_bug',
                    'level'            => 1,
                    'calculation_rule' => '{ "var" : ["@met_blocker_bug"] }',
                    'calculation_data' => '{ "@met_blocker_bug" : "@met_blocker_bug.value" }',
                    'lr_name'          => null,
                ),

                array(
                    'id'               => 6,
                    'tmpname'          => 'Critical bug',
                    'code'             => 'critical_bug',
                    'level'            => 1,
                    'calculation_rule' => '{ "var" : ["@met_critical_bug"] }',
                    'calculation_data' => '{ "@met_critical_bug" : "@met_critical_bug.value" }',
                    'lr_name'          => null,
                ),

                array(
                    'id'               => 7,
                    'tmpname'          => 'Major bug',
                    'code'             => 'major_bug',
                    'level'            => 1,
                    'calculation_rule' => '{ "var" : ["@met_major_bug"] }',
                    'calculation_data' => '{ "@met_major_bug" : "@met_major_bug.value" }',
                    'lr_name'          => null,
                ),

                array(
                    'id'               => 8,
                    'tmpname'          => 'Minor bug',
                    'code'             => 'minor_bug',
                    'level'            => 1,
                    'calculation_rule' => '{ "var" : ["@met_minor_bug"] }',
                    'calculation_data' => '{ "@met_minor_bug" : "@met_minor_bug.value" }',
                    'lr_name'          => null,
                ),

                array(
                    'id'               => 9,
                    'tmpname'          => 'Info bug',
                    'code'             => 'info_bug',
                    'level'            => 1,
                    'calculation_rule' => '{ "var" : ["@met_info_bug"] }',
                    'calculation_data' => '{ "@met_info_bug" : "@met_info_bug.value" }',
                    'lr_name'          => null,
                ),

                array(
                    'id'               => 10,
                    'tmpname'          => 'Blocker vulnerability',
                    'code'             => 'blocker_vulnerability',
                    'level'            => 1,
                    'calculation_rule' => '{ "var" : ["@met_blocker_vulnerability"] }',
                    'calculation_data' => '{ "@met_blocker_vulnerability" : "@met_blocker_vulnerability.value" }',
                    'lr_name'          => null,
                ),

                array(
                    'id'               => 11,
                    'tmpname'          => 'Critical vulnerability',
                    'code'             => 'critical_vulnerability',
                    'level'            => 1,
                    'calculation_rule' => '{ "var" : ["@met_critical_vulnerability"] }',
                    'calculation_data' => '{ "@met_critical_vulnerability" : "@met_critical_vulnerability.value" }',
                    'lr_name'          => null,
                ),

                array(
                    'id'               => 12,
                    'tmpname'          => 'Major vulnerability',
                    'code'             => 'major_vulnerability',
                    'level'            => 1,
                    'calculation_rule' => '{ "var" : ["@met_major_vulnerability"] }',
                    'calculation_data' => '{ "@met_major_vulnerability" : "@met_major_vulnerability.value" }',
                    'lr_name'          => null,
                ),

                array(
                    'id'               => 13,
                    'tmpname'          => 'Minor vulnerability',
                    'code'             => 'minor_vulnerability',
                    'level'            => 1,
                    'calculation_rule' => '{ "var" : ["@met_minor_vulnerability"] }',
                    'calculation_data' => '{ "@met_minor_vulnerability" : "@met_minor_vulnerability.value" }',
                    'lr_name'          => null,
                ),

                array(
                    'id'               => 14,
                    'tmpname'          => 'Info vulnerability',
                    'code'             => 'info_vulnerability',
                    'level'            => 1,
                    'calculation_rule' => '{ "var" : ["@met_info_vulnerability"] }',
                    'calculation_data' => '{ "@met_info_vulnerability" : "@met_info_vulnerability.value" }',
                    'lr_name'          => null,
                ),

                array(
                    'id'               => 15,
                    'tmpname'          => 'Blocker code smell',
                    'code'             => 'blocker_code_smell',
                    'level'            => 1,
                    'calculation_rule' => '{ "var" : ["@met_blocker_code_smell"] }',
                    'calculation_data' => '{ "@met_blocker_code_smell" : "@met_blocker_code_smell.value" }',
                    'lr_name'          => null,
                ),

                array(
                    'id'               => 16,
                    'tmpname'          => 'Critical code smell',
                    'code'             => 'critical_code_smell',
                    'level'            => 1,
                    'calculation_rule' => '{ "var" : ["@met_critical_code_smell"] }',
                    'calculation_data' => '{ "@met_critical_code_smell" : "@met_critical_code_smell.value" }',
                    'lr_name'          => null,
                ),

                array(
                    'id'               => 17,
                    'tmpname'          => 'Major code smell',
                    'code'             => 'major_code_smell',
                    'level'            => 1,
                    'calculation_rule' => '{ "var" : ["@met_major_code_smell"] }',
                    'calculation_data' => '{ "@met_major_code_smell" : "@met_major_code_smell.value" }',
                    'lr_name'          => null,
                ),

                array(
                    'id'               => 18,
                    'tmpname'          => 'Minor code smell',
                    'code'             => 'minor_code_smell',
                    'level'            => 1,
                    'calculation_rule' => '{ "var" : ["@met_minor_code_smell"] }',
                    'calculation_data' => '{ "@met_minor_code_smell" : "@met_minor_code_smell.value" }',
                    'lr_name'          => null,
                ),

                array(
                    'id'               => 19,
                    'tmpname'          => 'Info code smell',
                    'code'             => 'info_code_smell',
                    'level'            => 1,
                    'calculation_rule' => '{ "var" : ["@met_info_code_smell"] }',
                    'calculation_data' => '{ "@met_info_code_smell" : "@met_info_code_smell.value" }',
                    'lr_name'          => null,
                ),

                array(
                    'id'               => 20,
                    'tmpname'          => 'Brain overload',
                    'code'             => 'brain-overload',
                    'level'            => 1,
                    'calculation_rule' => '{ "var" : ["@met_brain-overload"] }',
                    'calculation_data' => '{ "@met_brain-overload" : "@met_brain-overload.value" }',
                    'lr_name'          => null,
                ),

                array(
                    'id'               => 21,
                    'tmpname'          => 'Bad practice',
                    'code'             => 'bad-practice',
                    'level'            => 1,
                    'calculation_rule' => '{ "var" : ["@met_bad-practice"] }',
                    'calculation_data' => '{ "@met_bad-practice" : "@met_bad-practice.value" }',
                    'lr_name'          => null,
                ),

                array(
                    'id'               => 22,
                    'tmpname'          => 'Cert',
                    'code'             => 'cert',
                    'level'            => 1,
                    'calculation_rule' => '{ "var" : ["@met_cert"] }',
                    'calculation_data' => '{ "@met_cert" : "@met_cert.value" }',
                    'lr_name'          => null,
                ),

                array(
                    'id'               => 23,
                    'tmpname'          => 'Clumsy',
                    'code'             => 'clumsy',
                    'level'            => 1,
                    'calculation_rule' => '{ "var" : ["@met_clumsy"] }',
                    'calculation_data' => '{ "@met_clumsy" : "@met_clumsy.value" }',
                    'lr_name'          => null,
                ),

                array(
                    'id'               => 24,
                    'tmpname'          => 'Confusing',
                    'code'             => 'confusing',
                    'level'            => 1,
                    'calculation_rule' => '{ "var" : ["@met_confusing"] }',
                    'calculation_data' => '{ "@met_confusing" : "@met_confusing.value" }',
                    'lr_name'          => null,
                ),

                array(
                    'id'               => 25,
                    'tmpname'          => 'Convention',
                    'code'             => 'convention',
                    'level'            => 1,
                    'calculation_rule' => '{ "var" : ["@met_convention"] }',
                    'calculation_data' => '{ "@met_convention" : "@met_convention.value" }',
                    'lr_name'          => null,
                ),

                array(
                    'id'               => 26,
                    'tmpname'          => 'Cwe',
                    'code'             => 'cwe',
                    'level'            => 1,
                    'calculation_rule' => '{ "var" : ["@met_cwe"] }',
                    'calculation_data' => '{ "@met_cwe" : "@met_cwe.value" }',
                    'lr_name'          => null,
                ),

                array(
                    'id'               => 27,
                    'tmpname'          => 'Design',
                    'code'             => 'design',
                    'level'            => 1,
                    'calculation_rule' => '{ "var" : ["@met_design"] }',
                    'calculation_data' => '{ "@met_design" : "@met_design.value" }',
                    'lr_name'          => null,
                ),

                array(
                    'id'               => 28,
                    'tmpname'          => 'Lock in',
                    'code'             => 'lock-in',
                    'level'            => 1,
                    'calculation_rule' => '{ "var" : ["@met_lock-in"] }',
                    'calculation_data' => '{ "@met_lock-in" : "@met_lock-in.value" }',
                    'lr_name'          => null,
                ),

                array(
                    'id'               => 29,
                    'tmpname'          => 'Misra',
                    'code'             => 'misra',
                    'level'            => 1,
                    'calculation_rule' => '{ "var" : ["@met_misra"] }',
                    'calculation_data' => '{ "@met_misra" : "@met_misra.value" }',
                    'lr_name'          => null,
                ),

                array(
                    'id'               => 30,
                    'tmpname'          => 'Owasp ',
                    'code'             => 'owasp-',
                    'level'            => 1,
                    'calculation_rule' => '{ "var" : ["@met_owasp-"] }',
                    'calculation_data' => '{ "@met_owasp-" : "@met_owasp-.value" }',
                    'lr_name'          => null,
                ),

                array(
                    'id'               => 31,
                    'tmpname'          => 'Pitfall',
                    'code'             => 'pitfall',
                    'level'            => 1,
                    'calculation_rule' => '{ "var" : ["@met_pitfall"] }',
                    'calculation_data' => '{ "@met_pitfall" : "@met_pitfall.value" }',
                    'lr_name'          => null,
                ),

                array(
                    'id'               => 32,
                    'tmpname'          => 'Sans top25 ',
                    'code'             => 'sans-top25-',
                    'level'            => 1,
                    'calculation_rule' => '{ "var" : ["@met_sans-top25-"] }',
                    'calculation_data' => '{ "@met_sans-top25-" : "@met_sans-top25-.value" }',
                    'lr_name'          => null,
                ),

                array(
                    'id'               => 33,
                    'tmpname'          => 'Security',
                    'code'             => 'security',
                    'level'            => 1,
                    'calculation_rule' => '{ "var" : ["@met_security"] }',
                    'calculation_data' => '{ "@met_security" : "@met_security.value" }',
                    'lr_name'          => null,
                ),

                array(
                    'id'               => 34,
                    'tmpname'          => 'Suspicious',
                    'code'             => 'suspicious',
                    'level'            => 1,
                    'calculation_rule' => '{ "var" : ["@met_suspicious"] }',
                    'calculation_data' => '{ "@met_suspicious" : "@met_suspicious.value" }',
                    'lr_name'          => null,
                ),

                array(
                    'id'               => 35,
                    'tmpname'          => 'Unpredictable',
                    'code'             => 'unpredictable',
                    'level'            => 1,
                    'calculation_rule' => '{ "var" : ["@met_unpredictable"] }',
                    'calculation_data' => '{ "@met_unpredictable" : "@met_unpredictable.value" }',
                    'lr_name'          => null,
                ),

                array(
                    'id'               => 36,
                    'tmpname'          => 'Unused',
                    'code'             => 'unused',
                    'level'            => 1,
                    'calculation_rule' => '{ "var" : ["@met_unused"] }',
                    'calculation_data' => '{ "@met_unused" : "@met_unused.value" }',
                    'lr_name'          => null,
                ),

                array(
                    'id'               => 37,
                    'tmpname'          => 'User experience',
                    'code'             => 'user-experience',
                    'level'            => 1,
                    'calculation_rule' => '{ "var" : ["@met_user-experience"] }',
                    'calculation_data' => '{ "@met_user-experience" : "@met_user-experience.value" }',
                    'lr_name'          => null,
                ),

                array(
                    'id'               => 38,
                    'tmpname'          => 'Coverage',
                    'code'             => 'coverage',
                    'level'            => 1,
                    'calculation_rule' => '{ "var" : ["@met_coverage"] }',
                    'calculation_data' => '{ "@met_coverage" : "@met_coverage.value" }',
                    'lr_name'          => null,
                ),

                array(
                    'id'               => 39,
                    'tmpname'          => 'Quind Health Code Bad Points - Limit',
                    'code'             => 'qhc_bad_points_limit',
                    'level'            => 2,
                    'calculation_rule' => '{"*": [{"/": [{"var": "@ind_nloc"}, {"var": "#ref_nloc_bad_points"}]}, {"var": "#ref_bad_points"}]}',
                    'calculation_data' => '{"@ind_nloc": "@ind_nloc.value","#ref_nloc_bad_points":1000,"#ref_bad_points":100}',
                    'lr_name'          => null,
                ),

                array(
                    'id'               => 40,
                    'tmpname'          => 'Quind Health Code Bad Points - Bugs',
                    'code'             => 'qhc_bad_points_bugs',
                    'level'            => 2,
                    'calculation_rule' => '{"+":[{"*":[ {"var": "@ind_blocker_bug"},15 ]},{"*":[ {"var": "@ind_critical_bug"},8 ]},{"*":[ {"var": "@ind_major_bug"},5 ]},{"*":[ {"var": "@ind_minor_bug"},3 ]},{"*":[ {"var": "@ind_info_bug"},1 ]}]}',
                    'calculation_data' => '{"@ind_blocker_bug":"@ind_blocker_bug.value","@ind_critical_bug":"@ind_critical_bug.value","@ind_major_bug":"@ind_major_bug.value","@ind_minor_bug":"@ind_minor_bug.value","@ind_info_bug":"@ind_info_bug}.value"}',
                    'lr_name'          => null,
                ),

                array(
                    'id'               => 41,
                    'tmpname'          => 'Quind Health Code Bad Points - Vulnerabilities',
                    'code'             => 'qhc_bad_points_vulnerabilities',
                    'level'            => 2,
                    'calculation_rule' => '{"+":[{"*":[ {"var": "@ind_blocker_vulnerability"},12 ]},{"*":[ {"var": "@ind_critical_vulnerability"},6 ]},{"*":[ {"var": "@ind_major_vulnerability"},3 ]},{"*":[ {"var": "@ind_minor_vulnerability"},2 ]},{"*":[ {"var": "@ind_info_vulnerability"},1 ]}]}',
                    'calculation_data' => '{"@ind_blocker_vulnerability":"@ind_blocker_vulnerability.value","@ind_critical_vulnerability":"@ind_critical_vulnerability.value","@ind_major_vulnerability":"@ind_major_vulnerability.value","@ind_minor_vulnerability":"@ind_minor_vulnerability.value","@ind_info_vulnerability":"@ind_info_vulnerability}.value"}',
                    'lr_name'          => null,
                ),

                array(
                    'id'               => 42,
                    'tmpname'          => 'Quind Health Code Bad Points - Code Smells',
                    'code'             => 'qhc_bad_points_code_smell',
                    'level'            => 2,
                    'calculation_rule' => '{"+":[{"*":[ {"var": "@ind_blocker_code_smell"},3 ]},{"*":[ {"var": "@ind_critical_code_smell"},2 ]},{"*":[ {"var": "@ind_major_code_smell"},1 ]},{"*":[ {"var": "@ind_minor_code_smell"},1 ]},{"*":[ {"var": "@ind_info_code_smell"},0 ]},{"*":[ {"var": "@ind_duplicated_blocks"},5 ]}]}',
                    'calculation_data' => '{"@ind_blocker_code_smell":"@ind_blocker_code_smell.value","@ind_critical_code_smell":"@ind_critical_code_smell.value","@ind_major_code_smell":"@ind_major_code_smell.value","@ind_minor_code_smell":"@ind_minor_code_smell.value","@ind_info_code_smell":"@ind_info_code_smell.value","@ind_duplicated_blocks":"@ind_duplicated_blocks.value"}',
                    'lr_name'          => null,
                ),

                array(
                    'id'               => 43,
                    'tmpname'          => 'Quind Health Code Bad Points - Total',
                    'code'             => 'qhc_bad_points_total',
                    'level'            => 3,
                    'calculation_rule' => '{"+":[{"var": "@ind_qhc_bad_points_bugs"},{"var": "@ind_qhc_bad_points_vulnerabilities"},{"var": "@ind_qhc_bad_points_code_smell"}]}',
                    'calculation_data' => '{"@ind_qhc_bad_points_bugs":"@ind_qhc_bad_points_bugs.value","@ind_qhc_bad_points_vulnerabilities":"@ind_qhc_bad_points_vulnerabilities.value","@ind_qhc_bad_points_code_smell":"@ind_qhc_bad_points_code_smell.value"}',
                    'lr_name'          => null,
                ),

                array(
                    'id'               => 44,
                    'tmpname'          => 'Quind Health Code General',
                    'code'             => 'qhc_general',
                    'level'            => 4,
                    'calculation_rule' => '{"if": [{">=": [{"var": "@ind_qhc_bad_points_limit"},{"var": "@ind_qhc_bad_points_total"}]}, {"*": [{"-": [1, {"/": [{"var": "@ind_qhc_bad_points_total"},{"var": "@ind_qhc_bad_points_limit"}]}]}, 100]}, 0]}',
                    'calculation_data' => '{"@ind_qhc_bad_points_total":"@ind_qhc_bad_points_total.value","@ind_qhc_bad_points_limit":"@ind_qhc_bad_points_limit.value"}',
                    'lr_name'          => 1,
                ),

                array(
                    'id'               => 45,
                    'tmpname'          => 'Duplicated blocks',
                    'code'             => 'duplicated_blocks',
                    'level'            => 1,
                    'calculation_rule' => '{ "var" : ["@met_duplicated_blocks"] }',
                    'calculation_data' => '{ "@met_duplicated_blocks" : "@met_duplicated_blocks.value" }',
                    'lr_name'          => null,
                ),

                array(
                    'id'               => 46,
                    'tmpname'          => 'Quind Reliability Bad Points - Limit',
                    'code'             => 'qre_bad_points_limit',
                    'level'            => 2,
                    'calculation_rule' => '{"*": [{"/": [{"var": "@ind_nloc"}, {"var": "#ref_nloc_bad_points"}]}, {"var": "#ref_bad_points"}]}',
                    'calculation_data' => '{"@ind_nloc": "@ind_nloc.value","#ref_nloc_bad_points":1000,"#ref_bad_points":30}',
                    'lr_name'          => null,
                ),

                array(
                    'id'               => 47,
                    'tmpname'          => 'Quind Reliability Bad Points - Bugs',
                    'code'             => 'qre_bad_points_bugs',
                    'level'            => 2,
                    'calculation_rule' => '{"+":[{"*":[ {"var": "@ind_blocker_bug"},10 ]},{"*":[ {"var": "@ind_critical_bug"},7 ]},{"*":[ {"var": "@ind_major_bug"},5 ]},{"*":[ {"var": "@ind_minor_bug"},1 ]},{"*":[ {"var": "@ind_info_bug"},0 ]}]}',
                    'calculation_data' => '{"@ind_blocker_bug":"@ind_blocker_bug.value","@ind_critical_bug":"@ind_critical_bug.value","@ind_major_bug":"@ind_major_bug.value","@ind_minor_bug":"@ind_minor_bug.value","@ind_info_bug":"@ind_info_bug}.value"}',
                    'lr_name'          => null,
                ),

                array(
                    'id'               => 48,
                    'tmpname'          => 'Quind Reliability Bad Points - Security',
                    'code'             => 'qre_bad_points_security',
                    'level'            => 2,
                    'calculation_rule' => '{"+":[{"*":[ {"var": "@ind_security"},10 ]},{"*":[ {"var": "@ind_sans-top25-"},10 ]},{"*":[ {"var": "@ind_owasp-"},10 ]},{"*":[ {"var": "@ind_cwe"},10 ]}]}',
                    'calculation_data' => '{"@ind_security":"@ind_security.value","@ind_sans-top25-":"@ind_sans-top25-.value","@ind_owasp-":"@ind_owasp-.value","@ind_cwe":"@ind_cwe.value"}',
                    'lr_name'          => null,
                ),

                array(
                    'id'               => 49,
                    'tmpname'          => 'Quind Reliability Bad Points - Risks',
                    'code'             => 'qre_bad_points_risks',
                    'level'            => 2,
                    'calculation_rule' => '{"+":[{"*":[ {"var": "@ind_suspicious"},2 ]},{"*":[ {"var": "@ind_unpredictable"},2 ]},{"*":[ {"var": "@ind_confusing"},2 ]},{"*":[ {"var": "@ind_pitfall"},2 ]}]}',
                    'calculation_data' => '{"@ind_suspicious":"@ind_suspicious.value","@ind_unpredictable":"@ind_unpredictable.value","@ind_confusing":"@ind_confusing.value","@ind_pitfall":"@ind_pitfall.value"}',
                    'lr_name'          => null,
                ),

                array(
                    'id'               => 50,
                    'tmpname'          => 'Quind Reliability Bad Points - Total',
                    'code'             => 'qre_bad_points_total',
                    'level'            => 3,
                    'calculation_rule' => '{"+":[{"var": "@ind_qre_bad_points_bugs"},{"var": "@ind_qre_bad_points_security"},{"var": "@ind_qre_bad_points_risks"}]}',
                    'calculation_data' => '{"@ind_qre_bad_points_bugs":"@ind_qre_bad_points_bugs.value","@ind_qre_bad_points_security":"@ind_qre_bad_points_security.value","@ind_qre_bad_points_risks":"@ind_qre_bad_points_risks.value"}',
                    'lr_name'          => null,
                ),

                array(
                    'id'               => 51,
                    'tmpname'          => 'Quind Reliability Point Scored',
                    'code'             => 'qre_point_scored',
                    'level'            => 4,
                    'calculation_rule' => '{"if": [{">=": [{"var": "@ind_qre_bad_points_limit"},{"var": "@ind_qre_bad_points_total"}]}, {"-": [1, {"/": [{"var": "@ind_qre_bad_points_total"},{"var": "@ind_qre_bad_points_limit"}]}]}, 0]}',
                    'calculation_data' => '{"@ind_qre_bad_points_total":"@ind_qre_bad_points_total.value","@ind_qre_bad_points_limit":"@ind_qre_bad_points_limit.value"}',
                    'lr_name'          => null,
                ),

                array(
                    'id'               => 52,
                    'tmpname'          => 'Quind Reliability General',
                    'code'             => 'qre_general',
                    'level'            => 5,
                    'calculation_rule' => ' {"*": [{"+":[{"*":[ {"var": "@ind_coverage"},0.8 ]},{"*":[ {"var": "@ind_qre_point_scored"},0.2 ]}]},100]}',
                    'calculation_data' => '{"@ind_coverage":"@ind_coverage.value","@ind_qre_point_scored":"@ind_qre_point_scored.value"}',
                    'lr_name'          => 2,
                ),

                array(
                    'id'               => 53,
                    'tmpname'          => 'Quind Potential Efficiency Bad Points - Limit',
                    'code'             => 'qpe_bad_points_limit',
                    'level'            => 2,
                    'calculation_rule' => '{"*": [{"/": [{"var": "@ind_nloc"}, {"var": "#ref_nloc_bad_points"}]}, {"var": "#ref_bad_points"}]}',
                    'calculation_data' => '{"@ind_nloc": "@ind_nloc.value","#ref_nloc_bad_points":1000,"#ref_bad_points":30}',
                    'lr_name'          => null,
                ),

                array(
                    'id'               => 54,
                    'tmpname'          => 'Quind Potential Efficiency Bad Points - Present',
                    'code'             => 'qpe_bad_points_present',
                    'level'            => 2,
                    'calculation_rule' => '{"+":[{"*":[ {"var": "@ind_brain-overload"},10 ]},{"*":[ {"var": "@ind_clumsy"},10 ]},{"*":[ {"var": "@ind_confusing"},10 ]},{"*":[ {"var": "@ind_design"},10 ]}]}',
                    'calculation_data' => '{"@ind_clumsy":"@ind_clumsy.value","@ind_design":"@ind_design.value","@ind_bad-practice":"@ind_bad-practice.value","@ind_cert":"@ind_cert.value"}',
                    'lr_name'          => null,
                ),

                array(
                    'id'               => 55,
                    'tmpname'          => 'Quind Potential Efficiency Bad Points - Future',
                    'code'             => 'qpe_bad_points_future',
                    'level'            => 2,
                    'calculation_rule' => '{"+":[{"*":[ {"var": "@ind_confusing"},5 ]},{"*":[ {"var": "@ind_brain-overload"},5 ]}]}',
                    'calculation_data' => '{"@ind_confusing":"@ind_confusing.value","@ind_brain-overload":"@ind_brain-overload.value"}',
                    'lr_name'          => null,
                ),

                array(
                    'id'               => 56,
                    'tmpname'          => 'Quind Potential Efficiency Bad Points - Total',
                    'code'             => 'qpe_bad_points_total',
                    'level'            => 3,
                    'calculation_rule' => '{"+":[{"var": "@ind_qpe_bad_points_present"},{"var": "@ind_qpe_bad_points_future"}]}',
                    'calculation_data' => '{"@ind_qpe_bad_points_present":"@ind_qpe_bad_points_present.value","@ind_qpe_bad_points_future":"@ind_qpe_bad_points_future.value"}',
                    'lr_name'          => null,
                ),

                array(
                    'id'               => 57,
                    'tmpname'          => 'Quind Potential Efficiency General',
                    'code'             => 'qpe_general',
                    'level'            => 4,
                    'calculation_rule' => '{"if": [{">=": [{"var": "@ind_qpe_bad_points_limit"},{"var": "@ind_qpe_bad_points_total"}]}, {"*": [{"-": [1, {"/": [{"var": "@ind_qpe_bad_points_total"},{"var": "@ind_qpe_bad_points_limit"}]}]}, 100]}, 0]}',
                    'calculation_data' => '{"@ind_qpe_bad_points_total":"@ind_qpe_bad_points_total.value","@ind_qpe_bad_points_limit":"@ind_qpe_bad_points_limit.value"}',
                    'lr_name'          => 3,
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
        Schema::dropIfExists('indicators');
    }
}
