<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registers', function (Blueprint $table) {
            $table->increments('id');
            $table->text('nik');
            $table->text('register_numb');
            $table->date('register_date');
            $table->date('account_date');
            $table->text('participant_numb')->nullable();
            $table->text('name');
            $table->text('diploma_name');
            $table->text('born_place');
            $table->date('born_date');
            $table->text('diploma_born_place');
            $table->date('diploma_born_date');
            $table->text('gender');
            $table->text('institution')->nullable();
            $table->text('diploma_numb');
            $table->text('credit_institution');
            $table->text('credit_prodi');
            $table->float('ipk');
            $table->text('location_code');
            $table->text('location_name');
            $table->text('position_code');
            $table->text('position_name');
            $table->text('education_code');
            $table->text('education_name');
            $table->text('formation_type');
            $table->text('verification_status');
            $table->text('testloc_code')->nullable();
            $table->text('testloc_name')->nullable();
            $table->text('exam_k2_numb')->nullable();
            $table->text('exam_certification_numb')->nullable();
            $table->text('str_numb')->nullable();
            $table->text('str_date')->nullable();
            $table->text('toefl')->nullable();
            $table->text('toefl_type')->nullable();
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
        Schema::dropIfExists('registers');
    }
}
