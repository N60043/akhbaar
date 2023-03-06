<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsSliderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_slider', function (Blueprint $table) {
            $table->id('slider_id');
            $table->bigInteger('news_id');
            $table->string('title');
            $table->longText('description')->nullable();
             $table->string('image')->nullable();
            $table->bigInteger('is_active')->default('1');
            $table->bigInteger('slider_order');
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
        Schema::dropIfExists('news_slider');
    }
}
