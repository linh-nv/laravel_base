<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAmountColForCapitalHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('capital_histories', function (Blueprint $table) {
            $table->unsignedBigInteger('amount')->change();
            $table->unsignedBigInteger('last_amount')->change();
        });
        Schema::table('shareholders', function (Blueprint $table) {
            $table->unsignedBigInteger('total_capital')->default(0)->change();
        });
        Schema::table('categories', function (Blueprint $table) {
            $table->unsignedBigInteger('recommend_amount')->default(0)->change();
        });
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('recommend_amount')->default(0)->change();
        });
        Schema::table('pawn_receipts', function (Blueprint $table) {
            $table->unsignedBigInteger('origin_amount')->change();
            $table->unsignedBigInteger('remaining_amount')->change();
            $table->unsignedBigInteger('interest_percent')->change();
            $table->unsignedBigInteger('interest_amount')->change();
            $table->unsignedBigInteger('interest_paid')->default(0)->change();
        });
        Schema::table('pawn_products', function (Blueprint $table) {
            $table->unsignedBigInteger('origin_amount')->change();
        });
        Schema::table('fund_histories', function (Blueprint $table) {
            $table->unsignedBigInteger('amount')->change();
            $table->unsignedBigInteger('last_amount')->change();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('capital_histories', function (Blueprint $table) {
            //
        });
    }
}
