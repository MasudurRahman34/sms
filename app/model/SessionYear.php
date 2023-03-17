<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class SessionYear extends Model
{

    //SoftDeletes
    use SoftDeletes;

    protected $date =['deleted_at'];


    public function Fee(){
        return $this->hasMany(Fee::class,'sessionYearId', 'id');
    }
    public function Section(){
        return $this->hasMany(Section::class,'sessionYearId', 'id');
    }
    public function ClassTeacher(){
        return $this->hasMany(Section::class,'sessionYearId', 'id');
    }
    public static $rules = [

        'sessionYear'=>'required','string','max:255',
    ];


}
