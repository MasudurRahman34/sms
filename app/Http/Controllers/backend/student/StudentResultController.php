<?php

namespace App\Http\Controllers\backend\student;

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

class StudentResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function __construct()
    {
        $this->middleware('auth:student');

    }

    public function index(){

        $subjects=Subject::where('bid', Auth::guard('student')->user()->bId)->get();
        $class=classes::where('bid', Auth::guard('student')->user()->bId)->get();
        $section=Section::where('bid', Auth::guard('student')->user()->bId)->get();
        $sessionYear= SessionYear::where('bId', Auth::guard('student')->user()->bId)->get();
        $exams= exam::where('bId', Auth::guard('student')->user()->bId)->get(); 

        return view('backend.student.pages.result.result')->with('class', $class)->with('section', $section)->with('sessionYear',$sessionYear)->with('exams',$exams);
    }

    public function result(Request $request)
    {
         $sectionId= $request->sectionId;
        $studentId=  Auth::guard('student')->user()->id;
            $students = DB::select("select firstName,lastName,roll,className,sectionName,sessionYear,students.group, sections.shift, students.studentId from students, sections, classes, session_years WHERE sections.classId=classes.id AND 
                students.sectionId=sections.id And session_years.id=sections.sessionYearId 
                AND students.id='$studentId' And sections.id='$sectionId'");

        $grade=Grade::orderBy('id','DESC')->where('bId', Auth::guard('student')->user()->bId)->with('classes')->get();

        $studentmarks=Mark::where('studentId',$studentId)
                                               ->where('markEntrystatus',1)
                                               ->where('published', 1)
                                               ->where('sessionYearId',$request->sessionYearId)
                                               ->where('examType',$request->examType)
                                               ->where('sectionId',$request->sectionId)
                                               ->with('Subject')
                                               ->get();

                                               //return $studentmarks;
        
        return view('backend.student.pages.result.myresult', ['students' => $students,'grade'=>$grade,'studentmarks'=>$studentmarks,'examTypeName'=>$request->examTypeName]);
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
}
