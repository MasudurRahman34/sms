<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    public static $rules = [

        'classId'=>'required',
        'subjectName'=>'required', 'string', 'max:255',
        'subjectCode'=>'required', 'string', 'max:255',
        'group'=>'required','string',
        
    ];
    public function classes(){
        return $this->belongsTo('App\model\classes','classId');
    }
}
