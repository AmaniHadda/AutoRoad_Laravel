<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  
    public function up()
    {
        Schema::create('event_favoris', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('event_id')->unsigned();
            $table->integer('favoris_id')->unsigned();
            $table->timestamps();
            $table->foreign('event_id')->references('id')->on('events')
            ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('favoris_id')->references('id')->on('favoris')
            ->onDelete('cascade')->onUpdate('cascade');
            });
    }

   
    public function down()
    {
        //
    }
};
