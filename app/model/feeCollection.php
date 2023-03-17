<?php

namespace App\model;
use App\model\Fee;
use App\model\Month;
use App\model\Student;

use Illuminate\Database\Eloquent\Model;

class feeCollection extends Model
{
    public function Fee(){
        return $this->belongsTo(Fee::class,'feeId');
    }
    public function Student(){
        return $this->belongsTo(Student::class,'id');
    }

    public function month(){
        return $this->belongsTo(month::class,'month');
    }
    public function Section(){
        return $this->belongsTo(Section::class,'sectionId');
    }
}
