<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//new add
//
//ok
use App\model\Homework;
use App\model\User;


use App\model\classes;
use App\model\Section;
use App\model\SessionYear;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
Use Illuminate\Support\Facades\DB;
Use Illuminate\Support\Facades\Auth;

class HomeworkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    /**
     * [__construct description]
     */
     public function __construct()
    {
        $this->middleware('auth');
    }


    //
    public function index()
    {
        //return the view of homework page
        $class= classes::where('bId', Auth::guard('web')->user()->bId)->get();
        $sessionYear= SessionYear::where('bId', Auth::guard('web')->user()->bId)->get();
        return view('backend.pages.homework.homework',compact("class","sessionYear"));
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
        //return $request;
         $validator= Validator::make($request->all(), Homework::$rules);
        if ($validator->fails()) {
            return response()->json(["errors"=>$validator->errors(), 400]);
        }else{

        
                $user = new Homework;
                $user->sessionYearId = $request->sessionYearId;
                $user->classId = $request->classId;
                $user->sectionId = $request->sectionId;
                $user->group = $request->group;
                $user->subjectId = $request->subjectId;
                $user->title = $request->title;
                $user->description = $request->description;
                $user->endDate = $request->endDate;
                $user->userId = Auth::guard('web')->user()->id;
                $user->bId = Auth::guard('web')->user()->bId;

                $user->save();
                
                
                return Response()->json(["success"=>'saved', "data"=>$user,201]);
            
        }    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
         $homeworkList=Homework::orderBy('id','DESC')->where('bId', Auth::guard('web')->user()->bId)->get();

        $data_table_render = DataTables::of($homeworkList)

            ->addColumn('action',function ($row){
                return '<button class="btn btn-info btn-sm" onClick="edithomework('.$row['id'].')"><i class="fa fa-edit"></i></button>'.
                    '<button  onClick="deletehomework('.$row['id'].')" class="btn btn-danger btn-sm delete_section"><i class="fa fa-trash-o"></i></button>';
            })
              ->editColumn('subjectId', function($homeworkList)
                          {
                             return $homeworkList->subject->subjectName;
                          })
              ->editColumn('sectionId', function($homeworkList)
                          {
                             return $homeworkList->section->sectionName;
                          })
              ->editColumn('classId', function($homeworkList)
                          {
                             return $homeworkList->section->classes->className;
                          })
               ->editColumn('userId', function($homeworkList)
                          {
                             return $homeworkList= Auth::guard('web')->user()->name;
                          })
            ->rawColumns(['action'])
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
         $homework = Homework::find($id);
//        return view('backend.AddClass.addStudentClass')
//            ->with('studentClss',$studentclg);
        return Response()->json($homework);
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
         //return $request;
         $validator= Validator::make($request->all(), Homework::$rules);
        if ($validator->fails()) {
            return response()->json(["errors"=>$validator->errors(), 400]);
        }else{

        
                $homework = Homework::find($id);
                $homework->sessionYearId = $request->sessionYearId;
                $homework->classId = $request->classId;
                $homework->sectionId = $request->sectionId;
                $homework->group = $request->group;
                $homework->subjectId = $request->subjectId;
                $homework->title = $request->title;
                $homework->description = $request->description;
                $homework->endDate = $request->endDate;
                $homework->userId = Auth::guard('web')->user()->id;
                $homework->bId = Auth::guard('web')->user()->bId;

                $homework->save();
                
                
                return Response()->json(["success"=>'Updated', "data"=>$homework,201]);
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $homework = Homework::find($id);
        if($homework){
            $homework->delete();
            return response()->json(["success"=>'Data Deleted',201]);
        }
        return response()->json(["error"=>'error',422]);
    }
}
