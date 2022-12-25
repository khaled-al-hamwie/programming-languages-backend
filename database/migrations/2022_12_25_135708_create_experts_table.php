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
            $table->unsignedBigInteger('category_id');
            $table->string('name', 45);
            $table->string('email', 245)->unique();
            $table->string('password', 245);
            $table->string('pic');
            $table->string('phone', 45)->unique();
            $table->string('address', 45);
            $table->string('openning_time', 245);
            $table->double('rating', 3, 1, true)->nullable();
            $table->double('balance');
            $table->foreign('category_id')->references('category_id')->on('categories')->cascadeOnDelete();
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
