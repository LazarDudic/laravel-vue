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
            $table->id();
            $table->string('title');
            $table->string('desc', 500);
            $table->longText('content');

            $table->bigInteger('owner_id')->unsigned();
            $table->foreign('owner_id')->references('id')->on('users')->onDelete('restrict');

            $table->unsignedBigInteger('image_id');
            $table->foreign('image_id')->references('id')->on('files')->onDelete('restrict');

            $table->bigInteger('lang_id')->unsigned();
            $table->foreign('lang_id')->references('id')->on('languages')->onDelete('restrict');

            $table->bigInteger('lang_group_id')->unsigned()->index();

            $table->enum('status', ['draft', 'published'])->default('draft')->index();

            $table->unique(['lang_id', 'lang_group_id']);

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
