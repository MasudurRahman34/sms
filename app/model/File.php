<?php

namespace App\model;
use App\model\Student;
use App\model\User;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    public function students(){
        return $this->belongsTo('App\Student','studentId');
    }

    public function users(){
        return $this->belongsTo('App\User','userId');
    }
    
    public function getUrlPath()
        {
            return Storage::url($this->path);
        }
}
