<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMainCategoriesTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('main_category_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('main_category_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['main_category_id', 'locale']);
            $table->string('name');
            $table->foreign('main_category_id')->references('id')->on('main_categories')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('main_category_translations');
    }
}
