<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('transaction_id');
            $table->string('incharge_doctor');
            $table->dateTime('date_admitted');
            $table->string('ward');
            $table->string('bed');
            $table->string('admitting_diagnosis')->nullable();
            $table->dateTime('date_discharge')->nullable();
            $table->string('final_diagnosis')->nullable();
            $table->string('doctors_prescription')->nullable();
            $table->string('total_bills')->nullable();
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
        Schema::dropIfExists('transactions');
    }
}
