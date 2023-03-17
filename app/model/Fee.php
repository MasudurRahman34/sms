<?php

namespace App\model;
use App\model\classes;
use App\model\feeHistory;
use App\model\feeCollection;

use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    public function classes(){
        return $this->belongsTo(classes::class,'classId');
    }
    public function feeHistory(){
        return $this->hasMany(feeHistory::class,'feeId','id');
    }
    public function feeCollection(){
        return $this->hasMany(feeCollection::class,'feeId','id');
    }

    public function SessionYear(){
        return $this->belongsTo(SessionYear::class,'sessionYearId');
    }
    public static $rules = [
        'name'=>'required', 'string', 'max:255',
        'amount'=>'required','min:10',
        'classId'=>'required',
        'status'=>'required',
        'type'=>'required', 'string',
    ];
}
