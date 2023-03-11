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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slogan');
            $table->string('logo');
            $table->string('flatLogo');
            $table->string('icon');
            $table->string('currency')->default('USD');
            $table->string('maps')->nullable();
            $table->bigInteger('phone');
            $table->bigInteger('whatsapp');
            $table->string('copyright');

            $table->timestamps();
        });
        DB::table('settings')->insert(
            array(
                'title' => 'Rent Car',
                'slogan' => 'Happy Your Trip',
                'logo' => 'logo.png',
                'flatLogo' => 'logo-flat.png',
                'icon' => 'icon.png',
                'phone' => '81290560851',
                'whatsapp' => '81290560851',
                'copyright' => 'Copyright@ made by <b>akmal</b> 2022',
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
        Schema::dropIfExists('settings');
    }
};
