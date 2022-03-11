<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFarmerCrops extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farmer_crops', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('farmer_id')->nullable();
            $table->string('crop')->nullable();
            $table->string('soiltype')->nullable();
            $table->string('cultivationtype')->nullable();
            $table->string('plantingdate')->nullable();
            $table->string('fielddetails')->nullable();
            $table->string('surveynumber')->nullable();
            $table->string('landarea')->nullable();
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
        Schema::dropIfExists('farmer_crops');
    }
}
