<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesRelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories_rel', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('parent_id')->unsigned()->index();
            $table->foreign('parent_id')->references('id')->on('categories')->onDelete('restrict');

            $table->bigInteger('child_id')->unsigned()->unique(); //unique zato sto jedna kategorija moze da ima samo jednog parenta
            $table->foreign('child_id')->references('id')->on('categories')->onDelete('restrict');
            
            $table->integer('order')->unsigned()->default(1);

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
        Schema::dropIfExists('categories_rel');
    }
}
