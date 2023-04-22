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
        Schema::create('apptrans', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('fullname');
            $table->string('reservation_fee');
            $table->string('mode_of_payment');
            $table->string('reference_no')->nullable();
            $table->string('payment')->nullable();
            $table->string('change')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apptrans');
    }
};
