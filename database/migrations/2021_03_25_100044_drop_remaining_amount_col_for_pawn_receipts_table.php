<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropRemainingAmountColForPawnReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pawn_receipts', function (Blueprint $table) {
            $table->dropColumn('remaining_amount');
            $table->integer('interest_period')->default(1);
            $table->dropColumn('type_id');
            $table->date('identify_date')->nullable();
            $table->string('identify_region')->nullable();

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
