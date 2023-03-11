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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('categoryId');
            $table->unsignedBigInteger('userId');
            $table->string('title');
            $table->string('slug');
            $table->text('body');
            $table->string('keyword')->nullable();
            $table->text('metaDescription')->nullable();
            $table->string('metaTitle')->nullable();
            $table->boolean('isActive')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('categoryId')
                ->references('id')
                ->on('blog_categories')
                ->after('slug');
            $table->foreign('userId')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('blogs');
    }
};
