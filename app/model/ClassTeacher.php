<?php

namespace App\model;

use App\model\Section;

use Illuminate\Database\Eloquent\Model;

class ClassTeacher extends Model
{
    public function Section(){
        return $this->belongsTo(Section::class,'sectionId');
    }
}
