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
        Schema::create('addtocartservices', function (Blueprint $table) {
            $table->id();
            $table->string('billing_no');
            $table->string('billing_date');
            $table->string('appointment_no');
            $table->string('user_id');
            $table->string('fullname');
            $table->string('consultation_date');
            $table->integer('servicecode');
            $table->string('service');
            $table->string('price');
            $table->string('sub-total')->nullable();
            $table->string('discount')->nullable();
            $table->string('doctors_fee')->nullable();
            $table->string('mode_of_payment')->nullable();
            $table->string('change')->nullable();
            $table->string('total')->nullable();
            $table->timestamps();
            $table->unique(['servicecode']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addtocartservices');
    }
};
