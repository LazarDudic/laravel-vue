<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('title');

            $table->bigInteger('lang_id')->unsigned();
            $table->foreign('lang_id')->references('id')->on('languages')->onDelete('restrict');

            $table->bigInteger('lang_group_id')->unsigned()->index();

            $table->enum('type', ['news', 'blog'])->index(); // ovo nam sluzi da jedna tabela moze da ima kategorije od news, eventasa ili drugih da ne moramo da pravimo vise

            $table->bigInteger('image_id')->unsigned()->nullable();
            $table->foreign('image_id')->references('id')->on('files')->onDelete('restrict');

            $table->unique(['lang_id', 'lang_group_id']);
            $table->unique(['lang_id', 'title', 'type']);
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
        Schema::dropIfExists('categories');
    }
}
