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
        Schema::create('rentings', function (Blueprint $table) {
            $table->id();
            $table->date('PUD');
            $table->date('DOD');
            $table->integer('NbreHours')->nullable();
            $table->integer('NbreDays')->nullable();
            $table->time('PUT');
            $table->string('STATUS')->default('Approved');
            $table->string('Confirmation')->default('not_payed');
            $table->integer('rentingPrice');
            $table->timestamps();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('vehicle_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rentings');
    }
};
