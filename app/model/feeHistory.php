<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class feeHistory extends Model
{
    public function Fee(){
        return $this->belongsTo(Fee::class,'feeId');
    }
}
