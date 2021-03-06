<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->increments('id');
            $table->text('results')->nullable();
            $table->float('winner_amount', 15, 2)->nullable();
            $table->float('amount', 15, 2);
            $table->timestamps();
            
            $table->unsignedInteger('procurement_id')->nullable();
            $table->unsignedInteger('won_by_price_id')->nullable();
            $table->unsignedInteger('winners_id')->nullable();

            $table->foreign('won_by_price_id')->references('id')->on('participants');
            $table->foreign('winners_id')->references('id')->on('participants');
            $table->foreign('procurement_id')->references('id')->on('procurements');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('results');
    }
}
