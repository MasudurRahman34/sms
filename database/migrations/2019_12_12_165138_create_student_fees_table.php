<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_fees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('studentId')->comment('feeCollection_table');
            $table->float('novGovtAmount')->comment('sum novGovt Amount From FeeCollection');
            $table->float('govtAmount',8,2)->comment('sum Govt Amount From FeeCollection');
            $table->float('totalAmount', 8,2)->comment('sum Govt Amount From FeeCollection');
            $table->float('due', 8,2);
            $table->integer('discount');
            $table->float('paidAmount');
            $table->integer('status');
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
        Schema::dropIfExists('student_fees');
    }
}
