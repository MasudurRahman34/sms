<?php

namespace App;
use App\model\schoolBranch;
use App\model\File;
use App\model\ClassTeacher;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','mobile','bId','readablePassword',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static $rules = [
        'email'=>['required', 'string', 'email', 'max:255', 'unique:users'],
        'name'=>['required', 'string', 'max:255'],
        'mobile'=>['required', 'string', 'max:255','unique:users'],
        'designation'=>['string', 'max:255'],

    ];

    public function schoolBranch(){
        return $this->belongsTo(schoolBranch::class, 'bId', 'id');
    }

    public function file(){
        return $this->hasMany(File::class,'userId', 'id');
    }
    public function ClassTeacher(){
        return $this->hasMany(ClassTeacher::class,'userId', 'id');
    }

}
