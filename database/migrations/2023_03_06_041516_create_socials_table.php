<?php

use Illuminate\Support\Facades\DB;
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
        Schema::create('socials', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image');
            $table->string('url')->default('#');
            $table->boolean('isActive')->default(true);
            $table->timestamps();
        });

        DB::table('socials')->insert(
            array(
                'name' => 'facebook',
                'image' => asset('/storage/icon/facebook.png'),
                'url' => 'https://www.facebook.com/ulfah.12',
            )
        );
        DB::table('socials')->insert(
            array(
                'name' => 'instagram',
                'image' => asset('/storage/icon/instagram.png'),
                'url' => 'https://www.instagram.com/thisme159/',
            )
        );
        DB::table('socials')->insert(
            array(
                'name' => 'twitter',
                'image' => asset('/storage/icon/twitter.png'),
                'url' => '#',
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
        Schema::dropIfExists('socials');
    }
};
