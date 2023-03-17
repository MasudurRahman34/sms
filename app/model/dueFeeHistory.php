<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class dueFeeHistory extends Model
{
    public function feeCollection(){
        return $this->belongsTo(dueFeeHistory::class,'feeCollectionId');
    }
}
