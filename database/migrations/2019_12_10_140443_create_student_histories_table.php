<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('sId')->comment('student_table_id');
            $table->integer('roll')->nullable();
            $table->unsignedBigInteger('sectionId')->comment('section_table_id');
            $table->unsignedBigInteger('bId')->comment('branch_table_id');
            $table->string('group', 30)->comment('groupname');
            $table->boolean('schoolarshipStatus')->comment('0=no, 1 =yes');
            $table->string('type', 30)->comment('regular, irregular');
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
        Schema::dropIfExists('student_histories');
    }
}
