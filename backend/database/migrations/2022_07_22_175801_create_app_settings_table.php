<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_settings', function (Blueprint $table) {
            $table->id();
            $table->string('version');
            $table->enum('url_lang_prefix', ['yes', 'no'])->default('no');

            $table->bigInteger('default_lang_id')->unsigned();
            $table->foreign('default_lang_id')->references('id')->on('languages')->onDelete('restrict');

            // $table->bigInteger('admin_directorium_id')->unsigned();
            // $table->foreign('admin_directorium_id')->references('id')->on('directoriums')->onDelete('restrict');

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
        Schema::dropIfExists('app_settings');
    }
}
