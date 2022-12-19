<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up()
    {
        Schema::create('periods', function (Blueprint $table) {
            $table->id('period_id');
            $table->integer('expert_id');
            $table->integer('day_id');
            $table->integer('status');
            $table->integer('start');
            $table->foreign('expert_id')->references('expert_id')->on('experts');
            $table->foreign('day_id')->references('day_id')->on('days');

        });
    }

    public function down()
    {
        
    }
};
