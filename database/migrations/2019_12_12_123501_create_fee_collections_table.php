<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeeCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fee_collections', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('studentId')->comment('student_table_id');
            $table->unsignedBigInteger('feeId')->comment('fee_table_id');
            $table->float('amount',8,2)->comment('amount');
            $table->float('due',8,2)->comment('due')->default(0);
            $table->float('totalAmount',8,2)->comment('total Amount');
            $table->string('transactionId')->default(0)->comment('for payment information');
            $table->string('type', 30)->default(0)->comment('transaction type');
            $table->string('accountNumber', 30)->default(0)->comment();
            $table->string('paidMonth', 30)->comment();
            $table->string('month', 30)->comment();
            $table->unsignedBigInteger('sessionYearId')->comment('sessionYear_table Id');
            $table->unsignedBigInteger('sectionId');
            $table->unsignedBigInteger('bId')->comment('branch_table_id');
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
        Schema::dropIfExists('fee_collections');
    }
}
