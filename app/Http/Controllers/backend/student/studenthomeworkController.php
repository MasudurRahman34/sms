<?php

namespace App\Http\Controllers\backend\student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\model\Homework;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
Use Illuminate\Support\Facades\DB;
Use Illuminate\Support\Facades\Auth;

class studenthomeworkController extends Controller
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
         return view('backend.student.pages.homework.homeworklist');
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

         $homework=Homework::where('bId', Auth::guard('student')->user()->bId)->where('sectionId',Auth::guard('student')->user()->sectionId)
                        ->get();
                        
                        $data_table_render = DataTables::of($homework)
                         ->editColumn('subjectId', function($homework)
                          {
                             return $homework->subject->subjectName;
                          })
                        ->addIndexColumn()
                        ->make(true);
                    return $data_table_render;
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
