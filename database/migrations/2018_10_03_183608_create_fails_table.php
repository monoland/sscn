<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fails', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('register_id')->unsigned()->unique();
            // $table->bigInteger('nik')->unique();
            // $table->text('name');
            // $table->text('diploma_name');
            $table->text('reason')->nullable();
            // $table->text('verification_name');
            // $table->date('verification_date');
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
        Schema::dropIfExists('fails');
    }
}
