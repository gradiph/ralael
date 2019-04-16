<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableRelations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('recipients', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('recipient_id')->references('id')->on('recipients')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('items', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('carts', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('item_id')->references('id')->on('items')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('images', function (Blueprint $table) {
            $table->foreign('item_id')->references('id')->on('items')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('payments', function (Blueprint $table) {
            $table->foreign('transaction_id')->references('id')->on('transactions')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('item_tag', function (Blueprint $table) {
            $table->foreign('item_id')->references('id')->on('items')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('item_transaction', function (Blueprint $table) {
            $table->foreign('item_id')->references('id')->on('items')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('transaction_id')->references('id')->on('transactions')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('status_transaction', function (Blueprint $table) {
            $table->foreign('status_id')->references('id')->on('statuses')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('transaction_id')->references('id')->on('transactions')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('admin_id')->references('id')->on('admins')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('cashflows', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cashflows', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        Schema::table('status_transaction', function (Blueprint $table) {
            $table->dropForeign(['admin_id']);
            $table->dropForeign(['transaction_id']);
            $table->dropForeign(['status_id']);
        });

        Schema::table('item_transaction', function (Blueprint $table) {
            $table->dropForeign(['transaction_id']);
            $table->dropForeign(['item_id']);
        });

        Schema::table('item_tag', function (Blueprint $table) {
            $table->dropForeign(['tag_id']);
            $table->dropForeign(['item_id']);
        });

        Schema::table('payments', function (Blueprint $table) {
            $table->dropForeign(['transaction_id']);
        });

        Schema::table('images', function (Blueprint $table) {
            $table->dropForeign(['item_id']);
        });

        Schema::table('carts', function (Blueprint $table) {
            $table->dropForeign(['item_id']);
            $table->dropForeign(['user_id']);
        });

        Schema::table('items', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->dropForeign(['recipient_id']);
            $table->dropForeign(['user_id']);
        });

        Schema::table('recipients', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
    }
}
