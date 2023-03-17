<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type',200);
            $table->string('image')->nullable();
            $table->unsignedBigInteger('userId')->nullable();
            $table->unsignedBigInteger('studentId')->nullable();
            $table->unsignedBigInteger('classId')->nullable();
            $table->string('className')->nullable();
            $table->string('fileName')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('studentId')->references('id')->on('students')
                ->onDelete('cascade');
            $table->foreign('userId')->references('id')->on('users')
                ->onDelete('cascade');
            $table->foreign('classId')->references('id')->on('classes')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
    }
}
