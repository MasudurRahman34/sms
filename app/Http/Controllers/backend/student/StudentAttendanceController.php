<?php

namespace App\Http\Controllers\backend\student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\Attendance;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class StudentAttendanceController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:student');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.student.pages.attendance.studentAttendanceview');
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
    public function show($month)
    {
     
        $Attendance=Attendance::orderBy('id','DESC')
                        ->where('studentId', Auth::guard('student')->user()->id)
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
        ->editColumn('studentId', function($Attendance)
            {
               return $Attendance->student->studentId;
            }) 
       
        ->addIndexColumn()
        ->make(true);
    return $data_table_render;


    }

    //student attendance percentage
    public function attendancePercentage($month)
    {
        $totalday=Attendance::where('studentId', Auth::guard('student')->user()->id)
                        ->whereMonth('created_at', $month)
                        ->count();
                        if($totalday==0){
                            $totalday=1;
                        }else{
                            $totalday=$totalday;
                        }
     
        $Attendance=Attendance::where('attendence','present')
                        ->where('studentId', Auth::guard('student')->user()->id)
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
    public function edit($id)
    {
        //
    }

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
}
