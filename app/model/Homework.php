<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

use App\model\User;
use App\model\Subject;
use App\model\Section;
class Homework extends Model
{
     public function User(){
        return $this->belongsTo(User::class,'userId');
    }

     public function subject(){
        return $this->belongsTo(Subject::class,'subjectId');
    }

     public function section(){
        return $this->belongsTo(Section::class,'sectionId');
    }


     public static $rules = [
    
        
        'sessionYearId'=>'required',
        'classId'=>'required',
        'sectionId'=>'required',
        'group'=>'required',
        'subjectId'=>'required',
        'title'=>'required',
        'description'=>'required',
        'endDate'=>'required',

    ];
}
