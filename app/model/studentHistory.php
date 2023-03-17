<?php

namespace App\model;
use App\model\Student;
use App\model\Section;
use Illuminate\Database\Eloquent\Model;

class studentHistory extends Model
{
    public function Student(){
        return $this->belongsTo(Student::class,'id');
    }
    public function Section(){
        return $this->belongsTo(Section::class,'sectionId');
    }
}
