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
        Schema::create('appo', function (Blueprint $table) {
            $table->id('appointment_id');
            $table->integer('user_id');
            $table->integer('expert_id');
            $table->integer('start_app');
           // $table->boolval('type')->default(false);
            /* Users: 0=>user, 1=>expert*/
           // $table->rememberToken();
           $table->foreign('expert_id')->references('expert_id')->on('experts');
           $table->foreign('user_id')->references('user_id')->on('User');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
