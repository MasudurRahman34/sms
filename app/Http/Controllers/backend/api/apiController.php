<?php

namespace App\Http\Controllers\backend\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\classes;
use App\model\Section;
use App\model\Attendance;
use App\model\Fee;
use App\model\Mark;
use App\model\month;
use App\model\schoolBranch;
use App\model\Subject;
use App\model\Student;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use LengthException;

class apiController extends Controller
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

    //find section
    public function section(Request $request)
    {
        $section= Section::where('classId', $request->classId)
                        ->where('sessionYearId', $request->sessionYearId)
                        ->where('shift', $request->shift)
                        ->get();
        return Response()->json($section);
    }


    //find student by section for admin//find section
    public function sectionbyclass(Request $request)
    {

        $section= Section::where('classId', $request->classId)
                        ->where('sessionYearId', $request->sessionYearId)
                        ->where('shift', $request->shift)
                        ->get();
        return Response()->json($section);
    }
    public function classsubject(Request $request)
    {
        $subjectlist= Subject::where('classId', $request->classId)
                        ->where('group', $request->group)
                        ->where('bId', Auth::guard('web')->user()->bId)
                        ->get();
        return Response()->json($subjectlist);
    }

    public function subjectListFromMarkTable(Request $request)
    {
        $sectionId= $request->sectionId;
        $classId= $request->classId;
        $group= $request->group;

        $examType=$request->examType;
        $sessionYearId=$request->sessionYearId;

        $bId=Auth::guard('web')->user()->bId;

        // $subjectlist= DB::select("subjects.id,subjects.subjectName
        //                             FROM subjects,marks
        //                             WHERE subjects.id=marks.subjectId
        //                             AND subjects.classId='$classId'
        //                             AND subjects.group='$group'
        //                             AND marks.sectionId='$sectionId'
        //                             AND marks.examType='$examType'
        //                             AND marks.sessionYearId='$sessionYearId'
        //                             AND marks.bId='$bId'
        //                             ");
        $subjectlist=DB::table('marks as m')
                        ->where('sectionId', $sectionId)
                        ->where('examType',$examType)
                        ->where('markEntrystatus',1)
                        ->where('published',0)
                        ->where('m.bId', Auth::guard('web')->user()->bId)
                        ->join('subjects as s', 'm.subjectId','=','s.id' )
                        ->select('subjectName','s.id', DB::raw("count(subjectId) as numberOfStudent"))
                        
                        ->groupBy('SubjectId')
                        ->get();
                      
        return Response()->json($subjectlist);
    }

    //fee list in a class
    public function classfeelist(Request $request)
    {
        $feelist= Fee::where('classId', $request->classId)
                        ->where('bId', Auth::guard('web')->user()->bId)
                        ->get();
        return Response()->json($feelist);
    }

    //fee list in a class
    public function classfeelistMonthly(Request $request)
    {
        $feelist= Fee::where('classId', $request->classId)
                        ->where('interval','monthly')
                        ->where('bId', Auth::guard('web')->user()->bId)
                        ->get();
        return Response()->json($feelist);
    }

    //fee amount
    public function feeamount(Request $request)
    {
        $feeamount= Fee::where('id', $request->feeId)
                        ->where('bId', Auth::guard('web')->user()->bId)
                        ->pluck('amount');
        return Response()->json($feeamount);
    }


    public function roleHasClassTeacher($id)
    {
        $roleHasClassTeacher = Role::with('permissions')->where('bId', '=', Auth::guard('web')->user()->bId)
				->whereHas('permissions', function($query) use ($id) {
    				$query->where('role_id', $id)->where('permission_id',106);
				})
  				->pluck('id');
        return Response()->json($roleHasClassTeacher);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function checkClassHasOptionalSubject($classid, $group)
    {
        $is_notEmpty=Subject::where('classId', $classid)->where('group', $group)->where('optionalstatus', true)->count();
        $optionalsubject=Subject::where('classId', $classid)->where('group', $group)->where('optionalstatus', true)->get();

        return response()->json(['optionalsubject'=>$optionalsubject, 'is_notEmpty'=>$is_notEmpty]);
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
    public function show($id)
    {
        //
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

    public function totalStudent(){
        $bId=Auth::guard('web')->user()->bId;
        $totalStudent=DB::select("select * from students, sections, classes WHERE sections.classId=classes.id AND students.sectionId=sections.id And students.bId='$bId'");
        $totalStudent =count($totalStudent);
        return Response()->json(["success"=>'Counted', "data"=>$totalStudent,201]);
       }

    public function StudentAttendancePercentage($month)
    {
    //$bId=Auth::guard('web')->user()->bId;

        $totalday=Attendance::where('bId',Auth::guard('web')->user()->bId)
                        ->whereMonth('created_at', $month)
                        ->count();
                        if($totalday==0){
                            $totalday=1;
                        }else{
                            $totalday=$totalday;
                        }

        $Attendance=Attendance::where('attendence','present')
                        ->where('bId',Auth::guard('web')->user()->bId)
                        ->whereMonth('created_at', $month)
                        ->count();
        $percentage = (100*$Attendance)/$totalday;
        // return $percentage;
        return Response()->json(["success"=>'Counted', "data"=>$percentage,201]);
    }


    //for individual student
    public function present(Request $request)
    {
    //$bId=Auth::guard('web')->user()->bId;
    $month=$request->month;
    $id=$request->studentId;
        $presentAttendance=Attendance::where('attendence','present')
                        ->where('studentId',$id)
                        ->whereMonth('created_at', $month)
                        ->count();

        // return $percentage;
        return Response()->json(["success"=>'presentThisMonth', "data"=>$presentAttendance,201]);
    }

    public function absent(Request $request)
    {
        $month=$request->month;
        $id=$request->studentId;

    $absent=Attendance::where('attendence','absent')
                    ->where('studentId',$id)
                    ->whereMonth('created_at', $month)
                    ->count();

         return Response()->json(["success"=>'Absent', "data"=>$absent,201]);

    }
    //collect student information for student Attendab=nce pdf in student deshboard .
    public function studentname()
    {

    $id=Auth::guard('student')->user()->id;

        $studentname=Student::where('id',$id)->with('schoolBranch')->get();

        // return $studentname;
        return Response()->json($studentname);

    }

    //total teacher in a school
    public function totalTeacher(){

    $totalteacher=User::where('bId',Auth::guard('web')->user()->bId)
                        ->where('designation','Teacher')
                        ->count();

    return Response()->json(["success"=>'Counted', "data"=>$totalteacher,201]);
    }

    public function totalUser(){

    $totalUser=User::where('bId',Auth::guard('web')->user()->bId)
                    ->count();

    return Response()->json(["success"=>'Counted', "data"=>$totalUser,201]);
    }

    public function totalsection(){

        $totalUser=Section::where('bId',Auth::guard('web')->user()->bId)->count();

        return Response()->json(["success"=>'Counted', "data"=>$totalUser,201]);
    }

    public function classwishAttentage(){

        $bId=Auth::guard('web')->user()->bId;
        $date= date('Y-m-d');
        $attendances=DB::select("SELECT classes.className, count(attendances.sectionId) as present, sections.sectionName, sections.shift
                                From sections, attendances, classes
                                where classes.id= sections.classId AND attendances.sectionId= sections.id
                                AND attendances.bId ='$bId'
                                AND attendances.attendence='present'
                                AND DATE(attendances.created_at)='$date'
                                GROUP BY attendances.sectionId
                                ");


        $data_table_render = DataTables::of($attendances)

            ->make(true);
        return $data_table_render;

    }
    public function sectionAttendance($classId,$sectionId,$dateId)
    {

        $bId=Auth::guard('web')->user()->bId;
        $attendance=Attendance::where('bId',$bId)
                        ->whereDate('created_at', $dateId)
                        ->where('sectionId', $sectionId)
                        ->where('classId', $classId)
                        ->with('student')->get();
        // $attendance=DB::select("SELECT * FROM students,attendances WHERE students.id=attendances.studentId AND attendances.classId='$classId' AND attendances.sectionId='$sectionId' AND attendances.bId='$bId' AND attendances.created_at='$dateId'");
        $data_table_render = DataTables::of($attendance)
        ->editColumn('created_at', function($attendance)
         {
            return $attendance->created_at->format('d-M-Y');
         })
         ->editColumn('student.firstName', function($attendance)
         {
            return $attendance->Student->firstName. " ".$attendance->Student->lastName;
         })


        ->addIndexColumn()
        ->make(true);
    return $data_table_render;

    }

    public function lastRoll($sectionId){
        try {
            $lastRoll= Student::where('sectionId', $sectionId)->latest()->FirstOrFail();

        } catch (ModelNotFoundException $exception) {

            return response()->json("Not Found");
        }

        return response()->json($lastRoll->roll);
    }

    public function optionalsubjectList(){
        $optinalsubject=Subject::get();
        return response()->json($optinalsubject);
    }

}
