<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up()
    {
        
        Schema::create('experts', function (Blueprint $table) {
            $table->integer('expert_id');
            //$table->unsignedBigInteger('category_id');
            $table->string('name', 45);
            $table->string('email');
            $table->string('password');
            //$table->string('pic')->nullable();
            //$table->string('phone', 45)->unique();
            //$table->string('address', 45);
            //$table->string('openning_time', 245);
            $table->double('balance');
            //$table->foreign('category_id');
        });
    }

    public function down()
    {
        
    }
};
