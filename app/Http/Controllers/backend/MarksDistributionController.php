<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//add;
use App\model\classes;
use App\model\exam;
use App\model\Mark;
use App\model\Student;
use App\model\Subject;
use App\model\Section;
use App\model\SessionYear;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Auth;
use App\model\studentoptionalsubject;

use App\model\Grade;

class MarksDistributionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $subjects=Subject::where('bid', Auth::guard('web')->user()->bId)->get();
        $class=classes::where('bid', Auth::guard('web')->user()->bId)->get();
        $section=Section::where('bid', Auth::guard('web')->user()->bId)->get();
        $sessionYear= SessionYear::where('bId', Auth::guard('web')->user()->bId)->get();

        return view('backend.pages.marksdistribution.marksDistributionStudent')->with('class', $class)->with('section', $section)->with('sessionYear',$sessionYear)->with('subjects',$subjects);
    }

    public function examattendanceindex()
    {
        $subjects=Subject::where('bid', Auth::guard('web')->user()->bId)->get();
        $class=classes::where('bid', Auth::guard('web')->user()->bId)->get();
        $section=Section::where('bid', Auth::guard('web')->user()->bId)->get();
        $sessionYear= SessionYear::where('bId', Auth::guard('web')->user()->bId)->get();

        return view('backend.pages.marksdistribution.examAttendance')->with('class', $class)->with('section', $section)->with('sessionYear',$sessionYear)->with('subjects',$subjects);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sectionwiselist($classId, $sectionId)
    {

            $class=DB::select("select * from students, sections, classes WHERE sections.classId=classes.id AND students.sectionId=sections.id And classes.id='$classId' And sections.id='$sectionId'");

                $data_table_render = DataTables::of($class)
                        ->addColumn('hash',function ($class){

                            return '#';
                        })
                        ->editColumn('firstName', function($student)
                          {
                             return $student->firstName. " ".$student->lastName;
                          })
                        ->addColumn('action',function ($class){
                            foreach ($class as $key => $cl) {
                                $edit_url = url('mystudent/show/studentProfile/'.$cl);
                                return '<a href="'.$edit_url.'" class="btn btn-info btn-xs"><i class="fa fa-edit"></i></a>';
                            }

                         })
                        ->rawColumns(['hash','action'])
                        ->make(true);
            return $data_table_render;
    }

    public function studentData(Request $request)
    {

        $sectionId= $request->sectionId;
        $group= $request->group;
        $subjectId=$request->subjectId;
        $optionalstatus=$request->optional;

        $sessionYearId=$request->sessionYearId;
        $classId=$request->classId;
        $examType=$request->examType;
        $shift=$request->shift;

        $bId=Auth::guard('web')->user()->bId;
        //find exam Attendance
        $examAttendanceList=Mark::where('sectionId', $sectionId)
            ->where('classId',$classId)
            ->where('examType',$examType)
            ->where('subjectId',$subjectId)
            ->where('sessionYearId',$sessionYearId)
            ->where('bId' , $bId)
            ->first();
        if($examAttendanceList!=null){

            $AttendStudents=DB::select("select students.firstName,students.id,students.roll,marks.examAttendence from
            students,marks
            where marks.studentId=students.id
            and marks.subjectId='$subjectId'
            and marks.sectionId='$sectionId'
            and marks.examType='$examType'
            and marks.sessionYearId='$sessionYearId'
            and marks.bId='$bId' ");

            return response()->json(["AttendStudents"=>$AttendStudents]);
        }else{

            if($optionalstatus==1){
                $students=DB::select("select * from
                students,studentoptionalsubjects
                where studentoptionalsubjects.studentId=students.id
                and studentoptionalsubjects.subjectId='$subjectId'
                and students.sectionId='$sectionId'");

                return response()->json($students);
            }else{
                if($group=="General"){
                    $students = Student::where('sectionId',$sectionId)->get();
                    return response()->json($students);

                }else{
                    $students = Student::where('sectionId',$sectionId)
                    ->where('group',$group)->get();
                    return response()->json($students);
                }
            }
        }
    }
    public function studenlist(Request $request)
    {

            $sectionId= $request->sectionId;
            $subjectId=$request->subjectId;
            $examType=$request->examType;
            $sessionYearId=$request->sessionYearId;

            $bId=Auth::guard('web')->user()->bId;


            $students=DB::select("select students.firstName,students.lastName,students.id,students.roll,marks.examAttendence,marks.ca,marks.mcq,marks.written,marks.practical,marks.total,marks.gradeName,marks.gradePoint FROM
            students,marks
            WHERE marks.studentId=students.id
            AND marks.subjectId='$subjectId'
            AND marks.sectionId='$sectionId'
            AND marks.examType='$examType'
            AND marks.sessionYearId='$sessionYearId'
            AND marks.bId='$bId'


            ");

            return response()->json($students);


    }


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

    public function examattendancestore(Request $request)
    {
        $Attendence= $request->Attendence;
        foreach ($Attendence as $id => $value) {

            $examAttendance = new Mark();
            $examAttendance->examAttendence = $value;
            $examAttendance->classId = $request->classId;
            $examAttendance->sectionId = $request->sectionId;
            $examAttendance->subjectId = $request->subjectId;
            $examAttendance->examType = $request->examType;
            $examAttendance->sessionYearId = $request->sessionYearId;

            $examAttendance->ca = 0;
            $examAttendance->mcq = 0;
            $examAttendance->written = 0;
            $examAttendance->practical = 0;
            $examAttendance->totalEightyPercentMark = 0;
            $examAttendance->total = 0;
            $examAttendance->gradeName = "F";
            $examAttendance->gradePoint = 0.0;
            $examAttendance->studentId = $id;

            $examAttendance->bId= Auth::user()->bId;
            $examAttendance->userId= Auth::user()->id;
            $examAttendance->save();
        }
        return response()->json(["success"=>'Saved',201]);
    }

    public function storemark(Request $request)
    {
        $id= $request->studentid;
         $marks = Mark::where('studentId', $request->studentid)
                                    ->where('subjectId',$request->subjectId)
                                    ->where('examType',$request->examType)
                                    ->where('sessionYearId',$request->sessionYearId)
                                    ->where('bId', Auth::guard('web')->user()->bId)
                                    ->first();
            if($marks!=null){
                $marks->ca = $request->ca;
                $marks->mcq = $request->mcq;
                $marks->written = $request->written;
                $marks->practical = $request->practical;
                $marks->total = $request->totalMarks;
                $marks->totalEightyPercentMark = $request->totalEightyPercentMark;
                $marks->gradeName = $request->grade;
                $marks->gradePoint = $request->gradePoint;
                $marks->markEntrystatus = 1;
                $marks->userId= Auth::guard('web')->user()->id;
                $marks->update();
                return response()->json(["success"=>'Saved',201,"id"=>$id]);

            }else{
             return "not found";
            }


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
    public function examattendanceupdate(Request $request)
    {
        //return($request->Attendence);

        $Attendence= $request->Attendence;
        foreach ($Attendence as $id => $value) {

            $updatEexamAttednance = Mark::where('studentId', $id)
                                    ->where('subjectId',$request->subjectId)
                                    ->where('examType',$request->examType)
                                    ->where('sessionYearId',$request->sessionYearId)
                                    ->where('bId', Auth::guard('web')->user()->bId)
                                    ->first();
            $updatEexamAttednance->examAttendence = $value;
            //$updatEexamAttednance->bId= Auth::guard('web')->user()->bId;
            $updatEexamAttednance->update();
        }
        return response()->json(["success"=>'Saved',201]);
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

    // public function resultIndex()
    // {
    //     $subjects=Subject::where('bid', Auth::guard('web')->user()->bId)->get();
    //     $class=classes::where('bid', Auth::guard('web')->user()->bId)->get();
    //     $section=Section::where('bid', Auth::guard('web')->user()->bId)->get();
    //     $sessionYear= SessionYear::where('bId', Auth::guard('web')->user()->bId)->get();
    //     $exams= exam::where('bId', Auth::guard('web')->user()->bId)->get();

    //     return view('backend.pages.marksdistribution.result2')->with('class', $class)->with('section', $section)->with('sessionYear',$sessionYear)->with('exams',$exams);
    // }

    // public function individualStudent2(Request $request)
    // {
    //     $sectionId= $request->sectionId;
    //     $studentId= $request->studentId;
    //         $students = DB::select("select firstName,lastName,roll,className,sectionName,sessionYear from students, sections, classes, session_years WHERE sections.classId=classes.id AND 
    //             students.sectionId=sections.id And session_years.id=sections.sessionYearId 
    //             AND students.id='$studentId' And sections.id='$sectionId'");


    //         // Student::where('sectionId',$sectionId)->where('id',$studentId)
    //         // ->where('bId', Auth::guard('web')->user()->bId)
    //         // ->get();
    //         //return $students;
    //          $studentinformation="";
    //     foreach ($students as $student) {
    //         $studentinformation.='<tr>'.
            
    //          '<th> Student Name </th>'.
    //         '<td>'.$student->firstName.' '.$student->lastName.'</td>'.'</tr><tr>'.
    //         ' <th>Roll</th>'.
    //         '<td>'.$student->roll.'</td>'.'</tr><tr>'.
    //         '<th>Class</th>'.
    //         '<td>'.$student->className.'</td>'.'</tr><tr>'.
    //         ' <th>Section</th>'.
    //         '<td>'.$student->sectionName.'</td>'.'</tr><tr>'.
    //         '<th>Session Year</th>'.
    //         '<td>'.$student->sessionYear.'</td>'.'</tr><tr>'.
            
            
            
    //         '</tr>';
    //     }

    //     $grade=Grade::orderBy('id','DESC')->where('bId', Auth::guard('web')->user()->bId)->with('classes')->get();


    //          $gradeinfo="";
    //         foreach ($grade as $studentgrade) {
    //         $gradeinfo.='<tr>'.
            
    //         '<td>'.$studentgrade->gradeName.'</td>'.
    //         '<td>'.$studentgrade->maxValue.' - '.$studentgrade->minValue.'</td>'.
    //         '<td>'.$studentgrade->gradePoint.'</td>'.
            
            
    //         '</tr>';
    //     }

    //     $studentmarks=Mark::where('studentId',$request->studentId)
    //                                            ->where('markEntrystatus',1)
    //                                            ->where('sessionYearId',$request->sessionYearId)
    //                                            ->where('examType',$request->examType)
    //                                            ->where('sectionId',$request->sectionId)
    //                                            ->with('Subject')
    //                                            ->get();

    //                                            //return $studentmarks;
    //     $result="";
    //     //     foreach ($studentmarks as $myresult) {

    //     //         if(strstr($myresult->Subject->subjectName, "Bangla")){

    //     //             $result.='<tr class="bangla">'.
            
    //     //     '<td>'.$myresult->Subject->subjectName.'</td>'.
    //     //     '<td>'.$myresult->mcq.'</td>'.
    //     //     '<td>'.$myresult->written.'</td>'.
    //     //     '<td>'.$myresult->practical.'</td>'.
    //     //     '<td>'.$myresult->ca.'</td>'.
    //     //     '<td>'.$myresult->total.'</td>'.
    //     //     '<td>'.$myresult->gradeName.'</td>'.
    //     //     '<td>'.$myresult->gradePoint.'</td>'.
            
            
    //     //     '</tr>';

    //     //         }

    //     // }

    //     //  foreach ($studentmarks as $myresult) {

                

    //     //         if(strstr($myresult->Subject->subjectName, "English")){


    //     //             $result.='<tr class="english">'.
                    
    //     //             '<td>'.$myresult->Subject->subjectName.'</td>'.
    //     //             '<td>'.$myresult->mcq.'</td>'.
    //     //             '<td>'.$myresult->written.'</td>'.
    //     //             '<td>'.$myresult->practical.'</td>'.
    //     //             '<td>'.$myresult->ca.'</td>'.
    //     //             '<td>'.$myresult->total.'</td>'.
    //     //             '<td>'.$myresult->gradeName.'</td>'.
    //     //             '<td>'.$myresult->gradePoint.'</td>'.
                    
                    
    //     //             '</tr>';
    //     //         }

    //     // }
    //     //  foreach ($studentmarks as $myresult) {

    //     //         if($myresult->Subject->subjectName !=similar_text($myresult->Subject->subjectName,'Bangla') && $myresult->Subject->subjectName !="English"){

    //     //              $result.='<tr class="other">'.
                    
    //     //             '<td>'.$myresult->Subject->subjectName.'</td>'.
    //     //             '<td>'.$myresult->mcq.'</td>'.
    //     //             '<td>'.$myresult->written.'</td>'.
    //     //             '<td>'.$myresult->practical.'</td>'.
    //     //             '<td>'.$myresult->ca.'</td>'.
    //     //             '<td>'.$myresult->total.'</td>'.
    //     //             '<td>'.$myresult->gradeName.'</td>'.
    //     //             '<td>'.$myresult->gradePoint.'</td>'.
                    
                    
    //     //             '</tr>';
    //     //         }
                        

    //     // }
    //     // foreach ($studentmarks as $myresult) {

            
    //     //     $result.='<tr class="bangla">'.
            
    //     //     '<td>'.$myresult->Subject->subjectName.'</td>'.
    //     //     '<td>'.$myresult->mcq.'</td>'.
    //     //     '<td>'.$myresult->written.'</td>'.
    //     //     '<td>'.$myresult->practical.'</td>'.
    //     //     '<td>'.$myresult->ca.'</td>'.
    //     //     '<td>'.$myresult->total.'</td>'.
    //     //     '<td>'.$myresult->gradeName.'</td>'.
    //     //     '<td>'.$myresult->gradePoint.'</td>'.
            
    //     //     '</tr>';
    //     // }

        
    //     return view('backend.pages.result.individualresult')->with('result',$result);

    //     return response()->json(["studentinformation"=>$studentinformation,"gradeinfo"=>$gradeinfo,"result"=>$result]);
    // }


}