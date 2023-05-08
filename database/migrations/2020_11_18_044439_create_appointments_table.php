<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('appointment_id');
            $table->integer('agent_id')->nullable();
            $table->string('customer_id');
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->string('customer_address')->nullable();
            $table->string('treatment');
            $table->string('source')->comment('ads,direct,reffrell,front_office,personal');
            $table->string('ads_name')->nullable();
            $table->dateTime('appointment_date_time');
            $table->string('status')->default('ongoing')->comment('ongoing,missed,converted,success');
            $table->string('visibility')->default('open')->comment('open,closed');
            $table->string('note')->nullable();
            $table->string('modified')->nullable();
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
        Schema::dropIfExists('appointments');
    }
}
