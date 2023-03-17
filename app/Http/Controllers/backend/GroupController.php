<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\classes;
use App\model\Group;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class GroupController extends Controller
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

     //form view
    public function index()
    {
        $class= classes::where('bId', Auth::user()->bId)->get();
        return view('backend.pages.classes.manageGroup',compact("class"));
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

     //create new group
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), Group::$rules);
        if($validator->fails()) {
            return response()->json(["errors"=>$validator->errors(),400]);
        }else{
            $group= new Group();
            // $group->classId = $request->classId;
            $group->group = $request->group;
            $group->bId = Auth::user()->bId;
            $group->save();
            return response()->json(["success"=>"Data saved", "data"=>$group, 201]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     //view group by school
    public function show()
    {
        $group=Group::orderBy('id','DESC')->where('bId', Auth::guard('web')->user()->bId)->with('classes')->get();
        $data_table_render = DataTables::of($group)

            ->addColumn('action',function ($row){
                return '<button class="btn btn-info btn-sm" onClick="editGroup('.$row['id'].')"><i class="fa fa-edit"></i></button>'.
                    '<button  onClick="deleteGroup('.$row['id'].')" class="btn btn-danger btn-sm delete_section"><i class="fa fa-trash-o"></i></button>';
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

     //find group by id for edit
    public function edit($id)
    {
      $group = Group::find($id);
        return response()->json($group);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //update group information
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), Group::$rules);
        if($validator->fails()){
            return response()->json(["error"=>$validator->erroes(),400]);
        }else{
            $group = Group::find($id);
            $group->classId = $request->classId;
            $group->group=$request->group;
            $group->bId= Auth::user()->bId;
            $group->Save();
            return response()->json(["success"=>'Updated', "data"=>$group,201]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //delete group information
    public function destroy($id)
    {

        $groupDelete = Group::find($id);
        if($groupDelete){
            $groupDelete->delete();
            return response()->json(["success"=>'data deleted',201]);
        }
        return response()->json(["error"=>'error',422]);
    }
}
