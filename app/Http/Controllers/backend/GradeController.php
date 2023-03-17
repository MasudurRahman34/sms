<?php

namespace App\Http\Controllers\backend;

use App\model\Grade;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\model\classes;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class GradeController extends Controller
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
        return view('backend.pages.grade.manageGrade',compact("class"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $grade = new Grade();

        $grade->gradeName = $request->gradeName;
        $grade->maxValue = $request->maxValue;
        $grade->minValue = $request->minValue;
        $grade->gradePoint = $request->gradePoint;
       // $grade->classId = $request->classId;
        $grade->bId = Auth::user()->bId;
        $grade->save();
        return response()->json(["success"=>'Saved', "data"=>$grade, 201]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $grade=Grade::orderBy('id','DESC')->where('bId', Auth::guard('web')->user()->bId)->with('classes')->get();
        $data_table_render = DataTables::of($grade)

            ->addColumn('action',function ($row){
                return '<button class="btn btn-info btn-sm" onClick="editGrade('.$row['id'].')"><i class="fa fa-edit"></i></button>'.
                    '<button  onClick="deleteGrade('.$row['id'].')" class="btn btn-danger btn-sm delete_section"><i class="fa fa-trash-o"></i></button>';
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
        $grade= Grade::find($id);
        return response()->json($grade);
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
        $grade = Grade::find($id);

        $grade->gradeName = $request->gradeName;
        $grade->maxValue = $request->maxValue;
        $grade->minValue = $request->minValue;
        $grade->gradePoint = $request->gradePoint;
       // $grade->classId = $request->classId;
        $grade->bId = Auth::user()->bId;
        $grade->save();
        return response()->json(["success"=>'Saved', "data"=>$grade, 201]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gradeDelete = Grade::find($id);
        if($gradeDelete){
            $gradeDelete->delete();
            return response()->json(["success"=>'data deleted',201]);
        }
        return response()->json(["error"=>'error',422]);
    }

    public function gradelist(Request $request)
    {
        $gradelist= Grade::where('bId', Auth::guard('web')->user()->bId)
                        ->get();
        return Response()->json($gradelist);
    }
}
