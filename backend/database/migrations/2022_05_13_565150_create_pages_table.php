<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('lang_id')->unsigned();
            $table->foreign('lang_id')->references('id')->on('languages')->onDelete('restrict');
            $table->bigInteger('lang_group_id')->unsigned()->index();

            $table->string('name')->index();
            $table->string('route')->index();
            $table->enum('main_menu_show', ['yes', 'no'])->default('no')->index();
            $table->enum('footer_menu_show', ['yes', 'no'])->default('no')->index();
            $table->enum('can_delete', ['yes', 'no'])->default('yes'); // da li se ova stranica moze obrisati
            $table->longText('json_rules')->nullable();
            $table->longText('json_values')->nullable();
            //title, meta title, desc, meta desc, text i ostale stvari sta god je potrebno na toj stranici

            $table->unique(['lang_id', 'name']);
            $table->unique(['lang_id', 'route']);
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
        Schema::dropIfExists('pages');
    }
};
