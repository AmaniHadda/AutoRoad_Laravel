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
        Schema::create('reclamations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')  // Change this to foreignId to define a foreign key
                ->constrained('users')   // Use constrained method to define the constraint
                ->onDelete('cascade');
            //$table->string('name');
            $table->string('subject');
            $table->string('message');
            $table->string('driver_name'); 
            $table->timestamps();


            //partie yossra

            //$table->unsignedBigInteger('trajet_id');
           // $table->foreign('trajet_id')->references('id')->on('trajets')->onDelete('cascade');
            //$table->unsignedBigInteger('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reclamations'); // Change 'reclamation' to 'reclamations'
    }
};
