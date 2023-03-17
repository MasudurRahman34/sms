<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\Section;
use App\model\SessionYear;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class SessionYearController extends Controller
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
        return view('backend.pages.classes.manageSession');
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

        $validator= Validator::make($request->all(), SessionYear::$rules);
        if ($validator->fails()) {
            return response()->json(["errors"=>$validator->errors(), 400]);
        }else{
            $sessionYear= new SessionYear();
            $sessionYear->sessionYear= $request->sessionYear;
            if($request->has('status')){
                $sessionYear->status= $request->status;

                DB::table('session_years')
                ->where('status',1)
                ->update(['status' => 0]);





            }else{
                $sessionYear->status=0;
            }

            $sessionYear->bId= Auth::user()->bId;
            $sessionYear->save();
            return response()->json(["success"=>"saved", "data"=>$sessionYear, 201]);
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
        $sessionYear=SessionYear::where('bId', Auth::user()->bId)->get();
        $data_table_render = DataTables::of($sessionYear)

            ->addColumn('action',function ($row){
                return '<button class="btn btn-info btn-sm" onClick="editSession('.$row['id'].')"><i class="fa fa-edit"></i></button>'.
                    '<button  onClick="deleteSession('.$row['id'].')" class="btn btn-danger btn-sm delete_section"><i class="fa fa-trash-o"></i></button>';
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
        $sessionYear = SessionYear::find($id);
            return response()->json($sessionYear);
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
        $validator = Validator::make($request->all(), SessionYear::$rules);
        if($validator->fails()){
            return response()->json(["error"=>$validator->errors(),400]);
        }else{
            $sessionYear = SessionYear::find($id);
            $sessionYear->sessionYear= $request->sessionYear;
            if($request->has('status')){
                $sessionYear->status= $request->status;

                DB::table('session_years')
                ->where('status',1)
                ->update(['status' => 0]);

            }else{
                $sessionYear->status=0;
            }
            $sessionYear->bId= Auth::user()->bId;
            $sessionYear->save();
            return response()->json(["success"=>'updated', "data"=>$sessionYear, 201]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //used SoftDeleted
    public function destroy($id)
    {
        // $SessionYear=SessionYear::find($id);
        // $section=Section::all();
        // foreach($section->sessionYear() as $s){
        // dd($s);


        // foreach($SessionYear->section() as $section){
        //     return response()->json($section);
        // }


         $sessionyearId = Section::where('sessionYearId', $id)->get();

         if(count($sessionyearId)>=1){

             return response()->json(["error"=>'Sorry! Session Contain section .CanNot be Deleted']);
             }else{

             $sessionYearDelete = SessionYear::find($id);
                if($sessionYearDelete){
                 $sessionYearDelete->delete();
                 return response()->json(["success"=>'Data successfully Deleted',201]);
             }
             return response()->json(["error"=>'error',422]);
         }


    }
    // public function readsoftdelete(){

    //     $sessionYearDelete = SessionYear::withTrashed()->get();
    //     $sessionYearDelete = SessionYear::onlyTrashed()->get();
    // }

    // public function restoresoftdelete(){

    //     $sessionYearDelete = SessionYear::withTrashed()->restore();


    // }

    // public function forcedeletesoftdelete(){
    //     //user where to find id
    //     $sessionYearDelete = SessionYear::withTrashed()->forceDelete();


    // }



}
