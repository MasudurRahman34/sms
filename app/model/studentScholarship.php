<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use App\model\Student;
use App\model\scholarship;

class studentScholarship extends Model
{
    //
    public function Student(){
        return $this->belongsTo(Student::class,'id');

    }
    public function scholarship(){
        return $this->belongsTo(scholarship::class,'scholershipId');

    }
    public function Fee(){
        return $this->belongsTo(Fee::class,'feeId');

    }
}
