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
        Schema::create('profile', function (Blueprint $table) {
            $table->intdiv('id_expert');
            $table->unsignedBigInteger('category_id');
            $table->string('pic')->nullable();
            $table->string('phone', 45)->unique();
            $table->string('address', 45);
            $table->string('openning_time', 245);
            $table->foreign('category_id');
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
