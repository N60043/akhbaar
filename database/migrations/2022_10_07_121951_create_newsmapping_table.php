<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsmappingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('newsmapping', function (Blueprint $table) {
            $table->id('newsmapping_id');
            $table->string('news_category_name')->nullable();
            $table->integer('news_category_id');
            $table->integer('newspaper_id');
            $table->string('category_url')->nullable();
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
        Schema::dropIfExists('newsmapping');
    }
}
