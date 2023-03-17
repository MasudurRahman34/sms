<?php

namespace App\model;
use App\model\schoolBranch;
use App\model\Section;
use App\model\studentHistory;
use App\model\Attendance;
use App\model\File;
use App\model\studentoptionalsubject;
use App\model\studentScholarship;
use App\model\feeCollection;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Authenticatable
{
    use Notifiable, HasRoles;

    protected $guard = 'student';


    //SoftDeletes
    use SoftDeletes;

    protected $date =['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','mobile','bId','readablePassword','address'
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
        'email'=>'required', 'string', 'email', 'max:255', 'unique:users',
        'name'=>'required', 'string', 'max:255',
        'mobile'=>'required', 'string', 'max:255','unique:users',
        'designation'=>'string', 'max:255',
        'joinDate'=>'string',  'max:255',
        'address'=>'required', 'string',  'max:255',

    ];
    // //student admission rules
    // public static $admissionRules = [
    //     'firstName'=>'required|min:3', 'string', 'max:255',
    //     'lastName'=>'required|min:3', 'string', 'max:255',
    //     'gender'=>'required',
    //     'email'=>'required', 'string', 'email', 'max:255', 'unique:users',
    //     'mobile'=>'required', 'string', 'max:255','unique:users',
    //     'birthDate'=>'required',
    //     'blood'=>'string',
    //     'address'=>'required', 'string',  'max:255',
    //     'password'=>'required', 'string', 'min:6', 'confirmed',
    //     'readablePassword'=>'required',
    //     'bId'=>'required',
    //     'sectionId'=>'required',
    //     'roll'=>'required',
    //     'group'=>'required',
    //     'type'=>'required',
    //     'schoolarshipId'=>'required',

    // ];
    public function files(){
        return $this->hasMany(File::class,'studentId', 'id');
    }

    public function schoolBranch(){
        return $this->belongsTo(schoolBranch::class,'bId');
    }
    public function Section(){
        return $this->belongsTo(Section::class,'sectionId');
    }
    public function attendence(){
        return $this->hasMany(Attendance::class,'studentId', 'id');
    }
    public function studentoptionalsubjects(){
        return $this->hasMany(studentoptionalsubject::class,'studentId', 'id');
    }
    public function studentHistory(){
        return $this->hasMany(studentHistory::class,'studentId', 'id');
    }
    public function feeCollection(){
        return $this->hasMany(feeCollection::class,'studentId', 'id');
    }
    public function studentScholarship(){
        return $this->hasMany(studentScholarship::class,'studentId', 'id');
    }

    public function Mark(){
        return $this->hasMany(Mark::class,'studentId', 'id');
    }


}

