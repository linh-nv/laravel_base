<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemakePawnTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pawn_products', function (Blueprint $table) {
            $table->dropColumn('identify');
        });

        Schema::table('pawn_receipts', function (Blueprint $table) {
            $table->timestamp('pawn_date')->after('interest_paid');
            $table->unsignedInteger('liquidated_day')->after('interest_paid');
            $table->dropColumn('deadline');
            $table->unsignedInteger('payment_day')->after('interest_paid');
            $table->text('note')->after('status_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pawn_products', function (Blueprint $table) {
            //
        });
    }
}
