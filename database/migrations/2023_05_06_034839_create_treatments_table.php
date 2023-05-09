<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTreatmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('treatments', function (Blueprint $table) {
            $table->id();
            $table->string('treatment_code');
            $table->string('treatment_name');
            $table->string('doctor_id');
            $table->string('treatment_time');
            $table->float('face_value', 8, 2);
            $table->float('actual_value', 8, 2);
            $table->float('hospital_charge', 8, 2);
            $table->float('agent_fee', 8, 2);
            $table->float('other_expense', 8, 2)->nullable();
            $table->text('note')->nullable();
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
        Schema::dropIfExists('treatments');
    }
}
