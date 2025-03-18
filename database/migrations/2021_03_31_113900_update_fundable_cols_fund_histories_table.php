<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateFundableColsFundHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fund_histories', function (Blueprint $table) {
            $table->unsignedBigInteger('invoice_type_id')->nullable();
            $table->unsignedBigInteger('fundable_id')->nullable()->change();
            $table->string('fundable_type', 50)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fund_histories', function (Blueprint $table) {
            //
        });
    }
}
