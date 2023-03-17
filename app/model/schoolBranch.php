<?php

namespace App\model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class schoolBranch extends Model
{
    public function user()
    {
        return $this->hasMany(User::class,'branchId');
    }
}
