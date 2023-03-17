<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('subjectName');
            $table->string('subjectCode');
            $table->unsignedInteger('classId')->comment('classId');
            $table->string('group',20)->comment('General','Science','Arts','Commerce','Optional');
            $table->unsignedInteger('bId');
            $table->boolean('optionalstatus')->default(false)->comment('1=true, 0= false');
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
        Schema::dropIfExists('subjects');
    }
}
