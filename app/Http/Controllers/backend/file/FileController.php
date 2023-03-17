<?php

namespace App\Http\Controllers\backend\file;

use Illuminate\Http\Request;
use App\model\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Controller;

class FileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //apply file form 
    public function applyFile(){
        return view('backend.pages.file.fileDocument');
    }

     //File store
     public function fileStore(Request $request){
         //1. Validation
        $this->validate($request,[
            'className'=>'required',
            'fileName'=>'required',
        ]);
        // 1. data insert
        $files = new File();
        $files->userId = Auth::user()->id;
        $files->className = $request->className;
        $files->fileName = $request->fileName;
        $files->type='book';
        $files->save();

        //message
        Session::flash('success','Succesfully File Uploaded Data Saved');
        return redirect()->back();
    }
     
    public function fileData(){

        $files=File::where('type','book')->get();
        $data_table_render = DataTables::of($files)
        ->addColumn('hash',function ($row){
        })
            ->editColumn('download', function ($files) {
                return '<a href="'.$files->fileName.'" class="btn btn-xs  btn-primary" target="_blank"><i class="fa fa-download" aria-hidden="true"></i></a>';
            })
            ->editColumn('className',function ($row){
                return ($row->className);
            })
            ->rawColumns(['download'=>'download','className'])
            ->addIndexColumn()
            ->make(true);
        return $data_table_render;
    }


}
