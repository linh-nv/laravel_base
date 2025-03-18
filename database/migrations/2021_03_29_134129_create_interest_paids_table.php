<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterestPaidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interest_paid_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pawn_receipt_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('interest_amount');
            $table->unsignedInteger('payment_round');
            $table->date('interest_pay_date')->nullable();
            $table->date('next_round_date')->nullable();
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
        Schema::dropIfExists('interest_paids');
    }
}
