<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePawnDateColForPawnReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pawn_receipts', function (Blueprint $table) {
            $table->dropColumn('pawn_date');
        });
        Schema::table('pawn_receipts', function (Blueprint $table) {
            $table->date('liquidation_date')->nullable()->after('code');
            $table->date('interest_payment_date')->nullable()->after('code');
            $table->date('pawn_date')->nullable()->after('code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pawn_receipts', function (Blueprint $table) {
            //
        });
    }
}
