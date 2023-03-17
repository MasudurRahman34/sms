<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\model\Student;
use App\model\Subject;
use App\model\Section;
use App\model\SessionYear;
use App\model\classes;
use App\model\Mark;
use Illuminate\Support\Facades\Auth;

class ResultPublish extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects=Subject::where('bid', Auth::guard('web')->user()->bId)->get();
        $class=classes::where('bid', Auth::guard('web')->user()->bId)->get();
        $section=Section::where('bid', Auth::guard('web')->user()->bId)->get();
        $sessionYear= SessionYear::where('bId', Auth::guard('web')->user()->bId)->get();

        return view('backend.pages.resultPublished.resultpublish')->with('class', $class)->with('section', $section)->with('sessionYear',$sessionYear)->with('subjects',$subjects);
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
    public function update(Request $request)
    {
        $sessionYearId=$request->sessionYearId;
        $subjectId=$request->subjectId;
        $sectionId= $request->sectionId;
        $examType=$request->examType;


        $StudentID = Mark::where('subjectId',$subjectId)
                        ->where('examType',$examType)
                        ->where('sectionId',$sectionId)
                        ->where('sessionYearId',$sessionYearId)
                        ->where('published',0)
                        ->where('markEntrystatus',1)
                        ->where('bId', Auth::guard('web')->user()->bId)
                        ->update(['published'=>1]);

            //$resultPublish = Mark::WhereIn('studentId',$StudentID)->update(['published'=>1]);


        return response()->json(["success"=>$StudentID,201]);



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
