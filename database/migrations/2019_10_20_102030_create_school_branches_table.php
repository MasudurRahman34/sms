<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_branches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('branchId')->unique()->nullable();
            $table->text('nameOfTheInstitution');
            $table->string('eiinNumber', 50);
            $table->string('email')->nullable()->unique();
            $table->string('phoneNumber')->unique();
            $table->string('district', 50);
            $table->string('upazilla', 50);
            $table->string('nameOfHead', 60);
            $table->string('schoolType', 50);
            $table->text('address');
            $table->boolean('activeStatus')->default(false);
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
        Schema::dropIfExists('school_branches');
    }
}
