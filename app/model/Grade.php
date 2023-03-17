<?php

namespace App\model;

use App\model\classes;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    public function classes(){
        return $this->belongsTo(classes::class,'classId');
    }
}
