<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('studentId');
            $table->string('attendence');
            $table->unsignedInteger('bId');
            $table->unsignedBigInteger('sectionId');
            $table->unsignedBigInteger('classId');
            $table->softDeletes();
            $table->foreign('sectionId')
                    ->references('id')->on('sections')
                    ->onDelete('cascade');
            $table->foreign('studentId')
                    ->references('id')->on('students')
                    ->onDelete('cascade');
            $table->foreign('classId')
                    ->references('id')->on('classes')
                    ->onDelete('cascade');
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
        Schema::dropIfExists('attendances');
    }
}
