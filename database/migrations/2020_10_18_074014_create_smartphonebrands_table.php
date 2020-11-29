<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmartphonebrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smartphonebrands', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->text('image');
             $table->text('slug');
            $table->text('description')->nullable();
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
        Schema::dropIfExists('smartphonebrands');
    }
}
