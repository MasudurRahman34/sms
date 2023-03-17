<?php

namespace App\Http\Controllers\backend;

use App\model\classes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\Section;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ClassesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     //form view

     public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {

        return view('backend.pages.classes.manageClass');
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

     //create new class
    public function store(Request $request)
    { $validator= Validator::make($request->all(), Classes::$rules);
        if ($validator->fails()) {
            return response()->json(["errors"=>$validator->errors(), 400]);
        }else{

        $Classes = new Classes();
        $Classes->className = $request->className;
        $Classes->duration = $request->duration;
        $Classes->bId = Auth::guard('web')->user()->bId;
        $Classes->seat= $request->seat;
        $Classes->save();

        //message
        return Response()->json(["success"=>'saved',"data"=>$Classes]);
        // Session::flash('success','Succesfully Add Class Data Saved');
        // return redirect()->back();
    }
}

    /**
     * Display the specified resource.
     *
     * @param  \App\model\classes  $classes
     * @return \Illuminate\Http\Response
     */

     //show classes information for this school
    public function show()
    {

        $Class=Classes::orderBy('id','DESC')->where('bId',Auth::guard('web')->user()->bId)->get();

        $data_table_render = DataTables::of($Class)

            ->addColumn('action',function ($row){

                return '<button class="btn btn-info btn-sm" onClick="editClass('.$row['id'].')"><i class="fa fa-edit"></i></button>'.
                    '<button  onClick="deleteStudentCls('.$row['id'].')" class="btn btn-danger btn-sm delete_class"><i class="fa fa-trash-o"></i></button>';
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        return $data_table_render;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\model\classes  $classes
     * @return \Illuminate\Http\Response
     */

     //find classes
    public function edit($id)
    {
        $studentclg = Classes::find($id);
        return Response()->json($studentclg);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\model\classes  $classes
     * @return \Illuminate\Http\Response
     */

     //update class information
    public function update(Request $request, $id)
    {
        $validator= Validator::make($request->all(), Classes::$rules);
        if ($validator->fails()) {
            return response()->json(["errors"=>$validator->errors(), 400]);
        }else{

       $class = Classes::find($id);
       $class->className = $request->className;
       $class->duration = $request->duration;
       $class->seat = $request->seat;

       $class->save();

        return response()->json(["success"=>'Stored', "data"=>$class ,201]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\model\classes  $classes
     * @return \Illuminate\Http\Response
     */

     //delete class information by id
    public function destroy($id)
    {

    $classId = Section::where('classId', $id)->get();

    if(count($classId)>=1){

        return response()->json(["error"=>'Sorry! This Class Contain Section. Can Not be Deleted']);
        }else{

            $studentCls = Classes::find($id);
                if($studentCls){
                    $studentCls->delete();
                    return response()->json(["success"=>'Data Deleted',201]);
                }
            return response()->json(["error"=>'error',422]);
        }
    }
}
