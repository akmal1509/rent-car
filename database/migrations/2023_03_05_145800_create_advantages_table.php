<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advantages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('body');
            $table->string('image');
            $table->timestamps();
        });

        DB::table('advantages')->insert(
            array(
                'name' => 'Fast Response',
                'body' => 'We will not waste your time, we will reply to your message as soon as possible',
                'image' => asset('/storage/advantages/fast-response.png')
            )
        );
        DB::table('advantages')->insert(
            array(
                'name' => 'Competitive Price',
                'body' => 'The best price on the market that won\'t drain your wallet',
                'image' => asset('/storage/advantages/price.png')
            )
        );
        DB::table('advantages')->insert(
            array(
                'name' => 'Variatif Car',
                'body' => 'We have a variety of cars, you can choose the car that you like the most',
                'image' => asset('/storage/advantages/car.png')
            )
        );
        DB::table('advantages')->insert(
            array(
                'name' => 'Driver Alredy',
                'body' => 'We have provided a driver if you need one',
                'image' => asset('/storage/advantages/driver.png')
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advantages');
    }
};
