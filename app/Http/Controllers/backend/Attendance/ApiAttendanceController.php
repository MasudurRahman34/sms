<?php

namespace App\Http\Controllers\backend\Attendance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\model\Attendance;
use App\model\SessionYear;
use App\model\classes;
use App\model\ClassTeacher;
use App\model\Section;
use App\model\Student;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class ApiAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        //
    }

    public function studentData(Request $request)
    {
        $attendences=Attendance::where('sectionId', $request->sectionId)
        ->whereDate('created_at',date('Y-m-d'))
        ->where('bId' , Auth::guard('web')->user()->bId)
        ->first();
        if($attendences!=null){

            return response()->json(["redirectToEdit"=>"/student/attendance/edit/$request->sectionId"]);
        }else{
            $sectionId= $request->sectionId;
            $students = Student::where('sectionId',$sectionId)->whereNull('deleted_at')->orderBy('id','ASC')->get();
            return response()->json($students);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
      //from view
      public function show($month, $studentId)
      {

          $Attendance=Attendance::orderBy('id','DESC')
                          ->where('studentId', $studentId)
                          ->whereMonth('created_at', $month)
                          ->get();
          $data_table_render = DataTables::of($Attendance)

          ->editColumn('created_at1', function($Attendance)
          {
             return $Attendance->created_at;
          })
          ->editColumn('created_at', function($Attendance)
              {
                 return $Attendance->created_at->diffForHumans();
              })

          ->addIndexColumn()
          ->make(true);
      return $data_table_render;


      }

      //student attendance percentage
      public function attendancePercentage($month, $studentId)
      {
          $totalday=Attendance::where('studentId', $studentId)
                          ->whereMonth('created_at', $month)
                          ->count();
                          if($totalday==0){
                              $totalday=1;
                          }else{
                              $totalday=$totalday;
                          }

          $Attendance=Attendance::where('attendence','present')
                          ->where('studentId', $studentId)
                          ->whereMonth('created_at', $month)
                          ->count();
           $percentage = (100*$Attendance)/$totalday;
           return $percentage;
      }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function absentlist()
    {
    $absentlist=Attendance::where('attendence','absent')
                        ->whereDate('created_at', '=', Carbon::today()->toDateString())->with('Student')
                        ->pluck('studentId');

         return Response()->json(["success"=>'Absent', "data"=>$absentlist,201]);

    }
}
