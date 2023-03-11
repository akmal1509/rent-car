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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('brandId');
            $table->unsignedBigInteger('userId');
            $table->string('name');
            $table->string('slug')->unique();
            $table->integer('capacity');
            $table->integer('year');
            $table->bigInteger('price');
            $table->string('image');
            $table->string('keyword')->nullable();
            $table->text('metaDescription')->nullable();
            $table->string('metaTitle')->nullable();
            $table->boolean('isActive')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('brandId')
                ->references('id')
                ->on('brands')
                ->after('slug');

            $table->foreign('userId')
                ->references('id')
                ->on('users')
                ->after('brandId');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars');
    }
};
