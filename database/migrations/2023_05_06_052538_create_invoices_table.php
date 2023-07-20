<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_id');
            $table->string('appoinment_id');
            $table->string('treatment');
            $table->float('discount', 8, 2)->nullable();
            $table->float('tax', 8, 2)->nullable();;
            $table->float('total', 8, 2);
            $table->string('payment_type');
            $table->float('pay_amount', 8, 2);
            $table->float('balance', 8, 2);
            $table->string('issued_by');
            $table->string('status')->comment('settled,not settled');
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
        Schema::dropIfExists('invoices');
    }
}
