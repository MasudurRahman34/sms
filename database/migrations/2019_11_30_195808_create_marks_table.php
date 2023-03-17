<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('studentId');
            $table->unsignedBigInteger('subjectId');
            $table->double('ca',8,2);
            $table->double('mcq',8,2);
            $table->double('written',8,2);
            $table->double('practical',8,2);
            $table->double('totalEightyPercentMark',8,2);
            $table->double('total',8,2);
            $table->string('gradeName');
            $table->double('gradePoint',8,2);
            $table->string('examType');
            $table->string('examAttendence');
            $table->unsignedInteger('bId');
            $table->unsignedBigInteger('sectionId');
            $table->unsignedBigInteger('classId');
            $table->unsignedInteger('sessionYearId')->comment('sessionYearId');
            $table->boolean('published')->default(0)->comment('0-> not published');
            $table->boolean('markEntrystatus')->default(0)->comment('0=not_Enter');
            $table->unsignedBigInteger('userId')->comment('mark_entry_user');
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
        Schema::dropIfExists('marks');
    }
}
