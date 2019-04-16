<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatusTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_transaction', function (Blueprint $table) {
            $table->unsignedTinyInteger('status_id');
            $table->unsignedBigInteger('transaction_id');
            $table->unsignedBigInteger('admin_id');
            $table->timestamp('creation_time');
            $table->string('description');

            $table->primary(['status_id', 'transaction_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('status_transaction');
    }
}
