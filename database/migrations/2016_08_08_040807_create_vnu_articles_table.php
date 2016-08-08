<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVnuArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vnu_articles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('js_article_id')->unsigned();
            $table->foreign('js_article_id')->references('id')->on('js');
            $table->string('cluster_id');
            $table->integer('cites');
            $table->text('mla');
            $table->text('apa');
            $table->text('iso');
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
        Schema::drop('vnu_articles');
    }
}
