<?php

namespace App\Http\Controllers;

use App\model\schoolBranch;
use App\model\District;
use App\model\Upazila;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApplyInstituteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     $district=District::all();

        return view('auth.applyInstitute', compact('district', $district));
    }
    public function getUpazilaByDistrict(Request $request)
    {
     $district=Upazila::where('district_id', $request->districtId)->get();

        return response()->json($district);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $branchId=mt_rand(100000,999999);
        $apIns= New schoolBranch;
        $apIns->nameOfTheInstitution=$request->nameOfTheInstitution;
        $apIns->branchId=$branchId;
        $apIns->eiinNumber=$request->eiinNumber;
        $apIns->phoneNumber=$request->phoneNumber;
        $apIns->district=$request->district;
        $apIns->upazilla=$request->upazilla;
        $apIns->nameOfHead=$request->nameOfHead;
        $apIns->schoolType=$request->schoolType;
        $apIns->address=$request->address;
        $apIns->save();
        return response()->json([
            "data"=>$apIns,
            "message" => "Success",
            200
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\model\ApplyInstitute  $applyInstitute
     * @return \Illuminate\Http\Response
     */
    public function show(ApplyInstitute $applyInstitute)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\model\ApplyInstitute  $applyInstitute
     * @return \Illuminate\Http\Response
     */
    public function edit(ApplyInstitute $applyInstitute)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\model\ApplyInstitute  $applyInstitute
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ApplyInstitute $applyInstitute)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\model\ApplyInstitute  $applyInstitute
     * @return \Illuminate\Http\Response
     */
    public function destroy(ApplyInstitute $applyInstitute)
    {
        //
    }
}
