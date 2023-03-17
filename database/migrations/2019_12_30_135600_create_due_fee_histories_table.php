<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDueFeeHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('due_fee_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('feeCollectionId')->comment('feeCection_table_id');
            $table->float('due',8,2)->comment('due')->default(0);
            $table->float('PreviousPaidAmount',8,2)->comment('feeCollection_table TotalAMount');
            $table->float('paidAmount',10,2)->comment('Fee Collection InputAmount')->default(0);
            $table->string('paidMonth', 30)->comment();
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
        Schema::dropIfExists('due_fee_histories');
    }
}
