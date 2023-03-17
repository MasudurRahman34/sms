<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeeHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fee_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('feeId')->comment('fee_table_id');
            $table->float('amount',8,2)->comment('amount');
            $table->unsignedBigInteger('sessionYearId')->comment('sessionYear_table Id');
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
        Schema::dropIfExists('fee_histories');
    }
}
