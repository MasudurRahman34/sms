<?php

namespace App\Http\Controllers\backend;

use App\model\feeHistory;
use App\model\Fee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class FeeHistoryController extends Controller
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

        return view('backend.pages.fee.feehistory');
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
     * @param  \App\model\feeHistory  $feeHistory
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $feehistory=feeHistory::orderBy('id','DESC')
                    ->where('bId', Auth::guard('web')->user()->bId)
                    ->with('Fee')
                    ->get();

         $data_table_render = DataTables::of($feehistory)

         ->editColumn('created_at', function($feehistory)
         {
            return $feehistory->created_at->format('d-M-Y');
         })

         ->editColumn('feeId', function($feehistory)
         {
             return $feehistory->Fee->name;
         })

        ->addIndexColumn()
        ->make(true);

         return $data_table_render;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\model\feeHistory  $feeHistory
     * @return \Illuminate\Http\Response
     */
    public function edit(feeHistory $feeHistory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\model\feeHistory  $feeHistory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, feeHistory $feeHistory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\model\feeHistory  $feeHistory
     * @return \Illuminate\Http\Response
     */
    public function destroy(feeHistory $feeHistory)
    {
        //
    }
}
