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
        Schema::create('global_settings', function (Blueprint $table) {
            $table->id();
            $table->string('sitename');
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('youtube')->nullable();
            $table->string('pinterest')->nullable();
            $table->string('instagram')->nullable();
            $table->string('discord')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('twitter_username')->nullable();
            $table->string('email');
            $table->string('email_public')->nullable();
            $table->text('header_scripts')->nullable();
            $table->string('facebook_app_id')->nullable();
            $table->string('copyright')->nullable();
            $table->string('author')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->text('footer_text')->nullable();
            $table->string('status_message')->nullable();

            $table->bigInteger('default_social_image_id')->unsigned()->nullable();
            $table->foreign('default_social_image_id')->references('id')->on('files')->onDelete('restrict');

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
        Schema::dropIfExists('global_settings');
    }
};
