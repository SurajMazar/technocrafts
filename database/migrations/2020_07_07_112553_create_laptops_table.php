<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaptopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laptops', function (Blueprint $table) {
          $table->id();
          $table->string('name');
          $table->string('slug');
          $table->string('dimension');
          $table->string('weight');
          $table->float('price');
          $table->string('cpu');
          $table->string('gui');
          $table->string('hdd');
          $table->string('RAM');
          $table->string('os');
          $table->string('battery');
          $table->string('featured_image');
          $table->text('related_images');
          // $table->date('featured_until');

          //port and connectivity
          $table->string('usb');
          $table->string('hdmi');
          $table->string('vga');
          $table->string('dvi');
          $table->string('ethernet');
          $table->string('card_reader');
          $table->string('wifi');
          $table->string('bluetooth');
          $table->string('audiojack');

          // features of laptop
          $table->string('webcamera');
          $table->string('webcamera_name')->nullable();
          $table->string('backlit_keyboard');
          $table->string('microphone');
          $table->string('speakers');
          $table->string('speaker_name')->nullable();
          $table->string('optical_drive');
          $table->string('security_lock');
          $table->string('security_lock_name')->nullable();
          $table->string('finger_print');

          //display
          $table->string('display');
          $table->string('diagonal');
          $table->string('resolution');
          $table->string('pixel_density');

          //seo
          $table->string('meta_title');
          $table->string('meta_keyword');
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
        Schema::dropIfExists('laptops');
    }
}
