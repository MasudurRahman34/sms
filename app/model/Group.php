<?php

namespace App\model;

use App\model\classes;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public function classes(){
        return $this->belongsTo('App\model\classes','classId');
    }
    public static $rules = [

        'group'=>'required','string','max:255',

    ];

}
