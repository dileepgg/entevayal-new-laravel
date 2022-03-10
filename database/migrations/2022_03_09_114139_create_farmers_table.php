<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFarmersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farmers', function (Blueprint $table) {
            $table->increments('farmer_id');
            $table->string('name');
            $table->integer('age');
            $table->string('gender');
            $table->string('email');
            $table->string('password');
            $table->string('security_question');
            $table->string('security_answer');
            $table->string('address');
            $table->string('district');
            $table->string('taluk');
            $table->string('block');
            $table->string('village');
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
        Schema::dropIfExists('farmers');
    }
}
