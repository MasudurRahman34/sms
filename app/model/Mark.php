<?php

namespace App\model;
use App\model\Student;
use App\model\Subject;

use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    public function Student(){
        return $this->belongsTo(Student::class, 'studentId');
    }
    public function Subject(){
        return $this->belongsTo(Subject::class,'subjectId')->orderBy('subjectName','asc');
    }
}
