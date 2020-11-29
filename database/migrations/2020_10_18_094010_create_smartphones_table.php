<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmartphonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smartphones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('smbrand_id')->references('id')->on('smartphonebrands')->onDelete('cascade');

            // basic features
            $table->text('name');
            $table->text('technology');
            $table->text('dimension');
            $table->text('weight');
            $table->text('sim');
            $table->double('price');
            $table->text('battery');
            $table->text('os');
            $table->text('chipset');
            $table->text('cpu');
            $table->text('gpu');
            $table->text('ram');
            $table->text('images');
            $table->text('colors');


            // memory
            $table->boolean('card_reader');
            $table->text('card_reader_description')->nullable();
            $table->text('internal_memory');


            // display
            $table->text('display');
            $table->text('size');
            $table->text('resolution');

            // front camera
            $table->text('frontcamera_type')->nullable();
            $table->text('frontcamera_feature')->nullable();
            $table->text('frontcamera_video')->nullable();

            //main camera
            $table->text('maincamera_type')->nullable();
            $table->text('maincamera_feature')->nullable();
            $table->text('maincamera_video')->nullable();

            // sound
            $table->boolean('loudspeaker');
            $table->text('loudspeaker_description')->nullable();
            $table->text('headphone_jack')->nullable();

            // commons
            $table->text('wlan');
            $table->text('bluetooth');
            $table->boolean('gps');
            $table->text('gps_description')->nullable();
            $table->boolean('nfc');
            $table->boolean('radio');
            $table->text('usb');

            //seo
            $table->text('meta_title');
            $table->text('meta_keyword');
            $table->text('meta_description');
            $table->SoftDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('smartphones');
    }
}
