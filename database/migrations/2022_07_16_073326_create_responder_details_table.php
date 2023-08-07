<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('responder_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('responder_id')->unsigned()->nullable()->defalut(NULL)->references('id')->on('responders');
            $table->bigInteger('anwered_counts')->unsigned()->nullable()->defalut(NULL);
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
        Schema::dropIfExists('responder_details');
    }
};
