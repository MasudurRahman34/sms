<?php

namespace App\model;
use App\model\SessionYear;
use App\model\Section;
use App\model\classes;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    public function classes(){
        return $this->belongsTo('App\model\classes','classId');
    }
    public function sessionYear(){
        return $this->belongsTo(SessionYear::class,'sessionYearId');
    }

    public function student(){
        return $this->belongsTo(Student::class,'studentId');
    }

    public function section(){
        return $this->belongsTo(Section::class, 'sectionId');
    }
    public static $rules = [
        
        'attendence'=>'required','array',
        
        
    ];

}
