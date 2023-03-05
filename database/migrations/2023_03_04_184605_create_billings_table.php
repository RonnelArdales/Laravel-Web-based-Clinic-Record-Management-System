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
            $table->string('billing_date');
            $table->string('appointment_no');
            $table->string('user_id');
            $table->string('fullname');
            $table->string('consultation_date');
            $table->string('servicecode');
            $table->string('service');
            $table->string('price');
            $table->string('sub-total')->nullable();
            $table->string('discount')->nullable();
            $table->string('doctors_fee')->nullable();
            $table->string('mode_of_payment')->nullable();
            $table->string('change')->nullable();
            $table->string('total')->nullable();
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
