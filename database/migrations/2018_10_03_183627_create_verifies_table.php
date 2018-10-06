<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVerifiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verifies', function (Blueprint $table) {
            $table->increments('id');
            $table->text('nik');
            $table->text('name');
            $table->text('diploma_name');
            $table->text('register_numb');
            $table->text('participant_numb')->nullable();
            $table->text('position_code');
            $table->text('position_name');
            $table->text('location_name');
            $table->text('domicile');
            $table->text('education_code');
            $table->text('education_name');
            $table->text('formation_type');
            $table->text('gender');
            $table->text('verification_name');
            $table->text('testloc_code')->nullable();
            $table->text('testloc_name')->nullable();
            $table->text('verification_date');
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
        Schema::dropIfExists('verifies');
    }
}
