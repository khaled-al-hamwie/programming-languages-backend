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
        Schema::create('experiences', function (Blueprint $table) {
            $table->unsignedBigInteger('experience_id', true);
            $table->unsignedBigInteger('expert_id');
            $table->string('name', 45);
            $table->string('details', 245);
            $table->boolean('is_private');
            $table->foreign('expert_id')->references('expert_id')->on('experts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('experiences');
    }
};
