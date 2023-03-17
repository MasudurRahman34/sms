<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentScholarshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_scholarships', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('studentId')->comment('student_table_id');
            $table->unsignedBigInteger('scholershipId')->nullable()->comment('schlarship table id');
            $table->unsignedBigInteger('feeId')->comment('fee_table_id');
            $table->float('discount',8,2)->comment('Discount %');
            $table->string('sessionYear')->comment('year of scholarship');
            $table->unsignedBigInteger('bId');
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
        Schema::dropIfExists('student_scholarships');
    }
}
