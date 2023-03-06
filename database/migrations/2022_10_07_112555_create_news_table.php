<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id('news_id');
            $table->bigInteger('news_uploader_id')->nullable();
            $table->string('title',255)->nullable();
            $table->longText('summary')->nullable();
            $table->longText('description')->nullable();
            $table->string('image');
            $table->date('date')->nullable(); 
            $table->bigInteger('news_category_id')->nullable();
            $table->bigInteger('news_sub_category_id')->nullable();
            $table->bigInteger('view_count')->nullable();
            $table->bigInteger('timestamp')->nullable();
            $table->string('status',11);
            $table->string('breaking_news')->default('De_Active')->nullable();
             $table->string('publish_timestamp')->default('De_Active')->nullable();
            $table->longText('tag')->nullable();
            $table->bigInteger('news_speciality_id')->nullable();
            $table->longText('img_features')->nullable();
            $table->bigInteger('news_reporter_id')->nullable();
            $table->bigInteger('newspaper_id');
            $table->string('news_api_id',11);
            $table->string('guid',11)->nullable();
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
        Schema::dropIfExists('news');
    }
}
