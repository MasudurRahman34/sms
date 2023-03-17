<?php

namespace App\model;
use App\model\feeCollection;

use Illuminate\Database\Eloquent\Model;

class month extends Model
{
    public function feeCollections(){
        return $this->hasMany(feeCollection::class,'month','month');
    }

}
