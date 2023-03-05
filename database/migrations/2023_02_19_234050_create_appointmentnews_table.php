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
        Schema::create('appointmentnews', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('fullname');
            $table->string('address');
            $table->string('email');
            $table->string('mobileno');
            $table->string('date');
            $table->string('time');
            $table->string('service');
            $table->string('price');
            $table->string('status')->nullable();
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
        Schema::dropIfExists('appointmentnews');
    }
};
