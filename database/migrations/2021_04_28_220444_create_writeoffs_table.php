<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWriteoffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('writeoffs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('amount');
            $table->float('price');
            $table->float('total');
            $table->unsignedBigInteger('good_id');
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
        Schema::dropIfExists('writeoffs');
    }
}
