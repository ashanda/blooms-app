<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDaySummeriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('day_summeries', function (Blueprint $table) {
            $table->id();
            $table->string('sale_agent_id');
            $table->string('whatsapp_chat');
            $table->string('whatsapp_call');
            $table->string('messenger_chat');
            $table->string('direct_call');
            $table->string('ads_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('day_summaries');
    }
}

