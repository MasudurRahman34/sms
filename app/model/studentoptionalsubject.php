<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class studentoptionalsubject extends Model
{
    public function Subject(){
        return $this->belongsTo('App\model\Subject','subjectId');
    }
}
