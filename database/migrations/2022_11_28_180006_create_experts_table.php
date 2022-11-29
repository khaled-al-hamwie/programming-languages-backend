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
        Schema::create('experts', function (Blueprint $table) {
            $table->unsignedBigInteger('expert_id', true);
            $table->string('name', 45);
            $table->binary('pic')->nullable();
            $table->string('phone', 45)->unique();
            $table->string('address', 45);
            $table->string('openning_time', 245);
            $table->double('rating', 3, 1, true)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('experts');
    }
};
