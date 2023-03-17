<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\model\exam;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
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
        //$class= classes::where('bId', Auth::user()->bId)->get();
        //return view('backend.pages.exam.manageExam',compact("class"));
        return view('backend.pages.exam.manageExam');
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
        $exam =new exam();
        $exam->examName =$request->examName;
        $exam->examCode =$request->examCode;

        $exam->bId= Auth::user()->bId;
        $exam->save();
        return response()->json(["success"=>'Saved',"data"=>$exam,201]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

        $exam=exam::orderBy('id','ASC')->where('bId', Auth::guard('web')->user()->bId)->get();
        $data_table_render = DataTables::of($exam)

            ->addColumn('action',function ($row){
                return '<button class="btn btn-info btn-sm" onClick="editExam('.$row['id'].')"><i class="fa fa-edit"></i></button>'.
                    '<button  onClick="deleteExam('.$row['id'].')" class="btn btn-danger btn-sm delete_section"><i class="fa fa-trash-o"></i></button>';
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
        $exam =exam::find($id);
        return response()->json($exam);
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
        $exam =exam::find($id);

        $exam->examName =$request->examName;
        $exam->examCode =$request->examCode;

        $exam->bId= Auth::user()->bId;
        $exam->save();
        return response()->json(["success"=>'Saved',"data"=>$exam,201]);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $examDelete = exam::find($id);
        if($examDelete){
            $examDelete->delete();
            return response()->json(["success"=>'Data Deleted From Recode',201]);
        }
        return response()->json(["error"=>'error',422]);
    }

    public function examlist(Request $request)
    {
        $gradelist= exam::where('bId', Auth::guard('web')->user()->bId)->get();
        return Response()->json($gradelist);
    }
}
