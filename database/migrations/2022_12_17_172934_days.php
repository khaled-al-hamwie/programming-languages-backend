<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    //$table->foreign('expert_id')->references('expert_id')->on('experts');
    public function up()
    {
        Schema::create('days', function (Blueprint $table) {
            $table->id('day_id');
            $table->integer('expert_id');
            $table->string('day');
            $table->timestamp('start_time');
            $table->timestamp('end_time');
            $table->foreign('expert_id')->references('expert_id')->on('experts');
        });
    }

    
    public function down()
    {
        
    }
};
