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
        Schema::create('consultations', function (Blueprint $table) {
            $table->id();
            $table->string('appointment_id');
            $table->string('user_id');
            $table->string('fullname');
            $table->dateTime('appointment_date');
            $table->string('behavioral_observation');
            $table->string('service');
            $table->string('sub-service');
            $table->string('brief_summary_encounter');
            $table->string('clinical_impression');
            $table->string('treatment_given');
            $table->string('recommendation');
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
        Schema::dropIfExists('consultations');
    }
};
