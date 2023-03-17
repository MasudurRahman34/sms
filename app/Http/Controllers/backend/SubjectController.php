<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\classes;
use App\model\Subject;

use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SubjectController extends Controller
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
        $class= classes::where('bId', Auth::user()->bId)->get();
        return view('backend.pages.classes.manageSubject',compact("class"));
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
        $validator = Validator::make($request->all(), Subject::$rules);
        if($validator->fails()) {

            return response()->json(["errors"=>$validator->errors(),400]);
        }else{
           

            foreach($request->classId as $classId)
            {
                $subject = new Subject();
            $subject->subjectName = $request->subjectName;
            $subject->subjectCode = $request->subjectCode;
            $subject->classId = $classId;
            $subject->group = $request->group;
           
            if($request->optionalstatus==null){
                $subject->optionalstatus = 0;
            }else{
                $subject->optionalstatus = $request->optionalstatus;
            }
            $subject->bId = Auth::user()->bId;
            $subject->save();
        }

            
            return response()->json(["success"=>'Saved', "data"=>$request->all(), 201]);

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
        $subjects=Subject::orderBy('id','DESC')->where('bId', Auth::guard('web')->user()->bId)->with('classes')->get();
        $data_table_render = DataTables::of($subjects)

        ->editColumn('optionalstatus', function($subjects)
            {
                return $subjects->optionalstatus == 1 ? 'Yes': 'No';
            })    
        ->addColumn('action',function ($row){
                return '<button class="btn btn-info btn-sm" onClick="editSubject('.$row['id'].')"><i class="fa fa-edit"></i></button>'.
                    '<button  onClick="deleteSubject('.$row['id'].')" class="btn btn-danger btn-sm delete_section"><i class="fa fa-trash-o"></i></button>';
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
        $subject = Subject::find($id);
        return response()->json($subject);
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
        $validator = Validator::make($request->all(), Subject::$rules);
        if($validator->fails()) {

            return response()->json(["errors"=>$validator->errors(),400]);
        }else{
            
            foreach($request->classId as $classId)
            {
                $subject = Subject::find($id);

            $subject->subjectName = $request->subjectName;
            $subject->subjectCode = $request->subjectCode;
            $subject->classId = $classId;
            $subject->group = $request->group;
            
            if($request->optionalstatus==null){
                $subject->optionalstatus = 0;
            }else{
                $subject->optionalstatus = $request->optionalstatus;
            }
            $subject->bId = Auth::user()->bId;
            $subject->save();
        }

            return response()->json(["success"=>'Saved', "data"=>$subject, 201]);

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
        $subjectDelete = Subject::find($id);
        if($subjectDelete){
            $subjectDelete->delete();
            return response()->json(["success"=>'data deleted',201]);
        }
        return response()->json(["error"=>'error',422]);
    }

}
