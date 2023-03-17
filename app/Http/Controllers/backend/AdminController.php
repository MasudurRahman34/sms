<?php
namespace App\Http\Controllers\backend;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use PHPUnit\Util\Json;
use App\User;
use App\model\classes;
use App\model\Attendance;
use App\model\Section;
use App\model\SessionYear;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=[];
        $upr= Auth::user()->getAllPermissions('name');
        $perm=Permission::get('id');


        foreach ($upr as $value) {
            if($value->name=='User Management'){
                $user=User::all();

                $data['user']=$user;

            }elseif($value->name=='Class'){
                $permission=Permission::all();
                $data['permission']=$permission;
            }
        }
        if(is_null($data)){
            return 'not available';
        }else{
        $class=classes::where('bid', Auth::guard('web')->user()->bId)->get();
        $section=Section::where('bid', Auth::guard('web')->user()->bId)->get();
        $sessionYear= SessionYear::where('bId', Auth::guard('web')->user()->bId)->get();

            // return view('backend.pages.mystudent.sectionwiseStudent')->with('class', $class)->with('section', $section)->with('sessionYear',$sessionYear);


            return view('backend.pages.index', array("data"=>$data))->with('class', $class)->with('section', $section)->with('sessionYear',$sessionYear);
        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return('working');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function totalStudent(){
        $bId=Auth::guard('web')->user()->bId;
        $totalStudent=DB::select("select * from students, sections, classes WHERE sections.classId=classes.id AND students.sectionId=sections.id And students.bId='$bId'");
        $totalStudent =count($totalStudent);
        return Response()->json(["success"=>'Counted', "data"=>$totalStudent,201]);
       }

    public function sectionAttendance()
    {
        return('working');
            $bId=Auth::guard('web')->user()->bId;
            $attendance=DB::select("SELECT * FROM attendances WHERE attendances.classId='$classId' AND attendances.sectionId='$sectionId' AND attendances.bId='$bId'");


    }





    //attendance

    //attendance


    /**
     * Display the specified resource.
     *
     * @param  \App\model\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\model\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\model\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\model\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //
    }
}
