<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatisticalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statistics', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fund_amount')->default(0)->comment('Số tiền có trong quỹ');

            $table->unsignedBigInteger('interest_count')->default(0)->comment('Số lượng khách trả lãi');
            $table->unsignedBigInteger('interest_amount')->default(0)->comment('Số tiền trả lãi');

            $table->unsignedBigInteger('loan_count_paid')->default(0)->comment('Số lượng khách trả gốc');
            $table->unsignedBigInteger('loan_amount_paid')->default(0)->comment('Số tiền trả gốc');

            $table->unsignedBigInteger('loan_count_new')->default(0)->comment('Số lượng khách vay mới');
            $table->unsignedBigInteger('loan_amount_new')->default(0)->comment('Số tiền cho vay mới');
            $table->integer('day')->nullable();
            $table->integer('month')->nullable();
            $table->integer('year')->nullable();
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
        Schema::dropIfExists('statisticals');
    }
}
