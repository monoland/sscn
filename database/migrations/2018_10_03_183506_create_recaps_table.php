<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recaps', function (Blueprint $table) {
            $table->increments('id');
            $table->text('code');
            $table->text('name');
            $table->text('type')->index();
            $table->text('position')->nullable()->index();
            $table->text('location')->nullable()->index();
            $table->text('education')->nullable()->index();
            $table->integer('formation')->unsigned()->default(0);
            $table->integer('registrar')->unsigned()->default(0);
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
        Schema::dropIfExists('recaps');
    }
}
