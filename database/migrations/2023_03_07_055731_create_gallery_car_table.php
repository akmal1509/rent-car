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
        Schema::create('gallery_car', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('carId');
            $table->string('image');
            $table->timestamps();

            $table->foreign('carId')
                ->references('id')
                ->on('brands')
                ->onUpdate('cascade')
                ->onDelete('cascade')
                ->after('slug');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gallery_car');
    }
};
