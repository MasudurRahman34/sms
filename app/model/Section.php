<?php

namespace App\model;
use App\model\SessionYear;
use App\model\classes;
use App\model\Student;
use App\model\ClassTeacher;



use Illuminate\Database\Eloquent\Model;

class Section extends Model
{

    public function classes(){
        return $this->belongsTo(classes::class,'classId');
    }
    public function sessionYear(){
        return $this->belongsTo(SessionYear::class,'sessionYearId');
    }
    public function Student(){
        return $this->hasMany(Student::class,'sectionId', 'id');
    }
    public function ClassTeacher(){
        return $this->belongsTo(ClassTeacher::class,'id');
    }

    public static $rules = [
        'sectionName'=>'required', 'string', 'max:255',
        'shift'=>'required', 'string',
        'sessionYearId'=>'required',
        'classId'=>'required',
    ];
}
