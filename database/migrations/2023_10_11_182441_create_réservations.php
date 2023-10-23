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
        Schema::create('réservations', function (Blueprint $table) {
            $table->id();
            $table->string('status')->default('En cours de traitement');
            $table->unsignedBigInteger('trajet_id');
            $table->foreign('trajet_id')->references('id')->on('trajets')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::table('réservations', function (Blueprint $table) {
            // Supprimez la contrainte de clé étrangère
            $table->dropForeign(['trajet_id']);
        });
        Schema::dropIfExists('réservations');
    }
};
