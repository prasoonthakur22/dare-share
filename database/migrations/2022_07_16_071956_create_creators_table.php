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
        Schema::create('creators', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('dare_id')->unsigned()->nullable()->defalut(NULL)->references('id')->on('dares');
            $table->string('name')->nullable()->defalut(NULL);
            $table->string('creator_ip')->nullable()->defalut(NULL);
            $table->text('share_url')->nullable()->defalut(NULL);
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
        Schema::dropIfExists('creators');
    }
};
