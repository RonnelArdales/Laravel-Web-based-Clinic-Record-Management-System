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
        Schema::create('billings', function (Blueprint $table) {
            $table->id();
            $table->string('billing_no');
            $table->string('user_id');
            $table->string('fullname');
            $table->string('servicecode');
            $table->string('service');
            $table->string('price');
            $table->string('sub_total')->nullable();
            $table->string('discount')->nullable();
            $table->string('total')->nullable();
            $table->string('mode_of_payment')->nullable();
            $table->string('reference_no')->nullable();
            $table->string('payment')->nullable();
            $table->string('change')->nullable();
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
        Schema::dropIfExists('billings');
    }
};
