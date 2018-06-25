<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcurementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procurements', function (Blueprint $table) {
            $table->increments('id');
            $table->string('identifier', 8)->nullable();
            $table->string('customer', 255);
            $table->string('id_procurement', 25)->unique();
            $table->dateTime('offers_period_end');
            $table->datetime('auction_period_end');
            $table->timestamp('created_at');
            $table->float('amount', 15, 2);
            $table->text('description')->nullable();


            $table->unsignedInteger('users_id')->nullable();
            $table->unsignedInteger('statuses_id')->default(1);
            $table->unsignedInteger('procurement_statuses_id')->nullable();
            $table->unsignedInteger('subjects_id')->nullable();
            $table->unsignedInteger('types_id')->nullable();


            $table->foreign('users_id')->references('id')->on('users');
            $table->foreign('subjects_id')->references('id')->on('subjects');
            $table->foreign('statuses_id')->references('id')->on('statuses');
            $table->foreign('procurement_statuses_id')->references('id')->on('procurement_statuses');
            $table->foreign('types_id')->references('id')->on('types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('procurements');
    }
}
