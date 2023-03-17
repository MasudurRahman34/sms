<?php

namespace App\model;
use App\model\Fee;
use App\model\Grade;

use Illuminate\Database\Eloquent\Model;

class classes extends Model
{
    public function Fee(){
        return $this->hasMany(Fee::class,'classId', 'id');
    }
    public function Grade(){
        return $this->hasMany(Grade::class,'classId', 'id');
    }
    public static $rules = [
        'className'=>'required', 'string', 'max:255',
        'duration'=>'required', 'string',
        'seat'=>'required','integer',
    ];

}
