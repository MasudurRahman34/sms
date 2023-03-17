<?php

namespace App\Http\Controllers\backend\student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StudentSubjectListController extends Controller
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

    public function index()
    {
        $id=Auth::guard('student')->user()->id;
        $subjectlists=DB::select("select  subjects.*  from classes, sections, students, subjects
        where students.sectionId=sections.id and sections.classId=classes.id and classes.id=subjects.classId and subjects.group in (students.group, 'General') and subjects.optionalstatus=false and students.id='$id'");
        // return $subjectlist;
        // $opsubjectlist=DB::select("select  subjects.*  from classes, sections, students, subjects
        // where students.sectionId=sections.id and sections.classId=classes.id and classes.id=subjects.classId and subjects.group in (students.group, 'General') and subjects.optionalstatus=1 and students.id='$id'");
        $Student=student::find($id);

        return view('backend.student.pages.subject.subjectList',compact('subjectlists', 'Student'));
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
    public function show()
    {
        $id=Auth::guard('student')->user()->id;
        $opsubjectlist=DB::select("select  subjects.subjectName  from classes, sections, students, subjects
        where students.sectionId=sections.id and sections.classId=classes.id and classes.id=subjects.classId and subjects.group in (student.group, 'General') and subjects.optionalstatus=1 and students.id='$id'");

        // $data_table_render = DataTables::of($subjectlist)
        // ->addColumn('hash',function ($row){
        //     $i=0;

        //     return '#';

        //      })

        // ->rawColumns(['hash'])
        // ->make(true);

        //  return $data_table_render;
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
