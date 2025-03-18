<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePawnReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pawn_receipts', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->unsignedBigInteger('customer_id');
            $table->string('name');
            $table->string('phone');
            $table->string('address')->nullable();
            $table->string('identify_number')->nullable();
            $table->unsignedBigInteger('user_id')->comment('User create the receipt');
            $table->double('origin_amount');
            $table->double('remaining_amount');
            $table->double('interest_percent');
            $table->double('interest_amount');
            $table->double('interest_paid')->default(0);
            $table->timestamp('deadline');
            $table->integer('type_id')->default(1);
            $table->integer('status_id')->default(1);
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
        Schema::dropIfExists('pawn_receipts');
    }
}
