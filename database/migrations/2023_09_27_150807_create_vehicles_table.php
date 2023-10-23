<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('Model');
            $table->string('Vehicle_Condition');
            $table->string('Color');
            $table->integer('Price');
            $table->integer('PriceDay')->default(0);
            $table->string('Fuel_Type');
            $table->string('Image');
            $table->string('Fuel_Consumption');
            $table->string('Status')->default('Available');
            $table->string('Current_Owner')->default('No One');
            $table->string('Features');
            $table->foreignId('user_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
};
