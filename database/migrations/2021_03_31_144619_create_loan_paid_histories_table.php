<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanPaidHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_paid_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pawn_receipt_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('loan');
            $table->unsignedBigInteger('last_loan');
            $table->date('loan_payment_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loan_paid_histories');
    }
}
