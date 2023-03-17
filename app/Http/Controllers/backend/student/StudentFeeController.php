<?php

namespace App\Http\Controllers\backend\student;
use App\Http\Controllers\Controller;
use App\model\Fee;
use App\model\feeCollection;
use App\model\month;
use App\model\SessionYear;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentFeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:student');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sessionYear= SessionYear::where('bId', Auth::guard('student')->user()->bId)->get();
        return view('backend.student.pages.fee.studentFeeView', compact("sessionYear"));
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
     * @param  \App\model\studentFee  $studentFee
     * @return \Illuminate\Http\Response
     */
    public function show($id,$sessionYearId)
    {
       // $cur_year=22;
        //$cur_year= Auth::guard('student')->user()->Section->sessionYear->id;
        $cur_year= $sessionYearId;
        //return($id);
        //feeCollection query by studentId & month
        $feeCollection=feeCollection::orderBy('id','DESC')
        ->where('studentId', Auth::guard('student')->user()->id)
        ->where('sessionYearId', $cur_year)
        ->where('month', $id)
        ->with('Fee')->get();
        //return($feeCollection);
        //feeCollection query by studentId & check their month & total fee paied
        $totalAmountPay=feeCollection::where('studentId', Auth::guard('student')->user()->id)
         ->where('sessionYearId', $cur_year)
        ->where('month', $id)
        ->sum('totalAmount');

        $tableOutPut="";
        foreach ($feeCollection as $fcollection) {
            $tableOutPut.='<tr>'.
            '<td>'.$fcollection->DT_RowIndex."#".'</td>'.
            '<td>'.$fcollection->created_at->format('d-M-Y').'</td>'.
            '<td>'.$fcollection->Fee->name.'</td>'.
            '<td>'.$fcollection->Fee->type.'</td>'.
            '<td>'.$fcollection->totalAmount.'</td>'.
            '</tr>';
        }
        return Response()->json(["totalAmountPay"=>$totalAmountPay, "tableOutPut"=>$tableOutPut]);

    }

    //student due fee page
    public function dueFee(){
        $sessionYear= SessionYear::where('bId', Auth::guard('student')->user()->bId)->get();
        return view('backend.student.pages.fee.studentDueFees',compact("sessionYear"));
    }
    //Bringing to fee_collections data where to check "interval" monthly due fees this specific student
    public function dueFee2($month,$sessionYearId,$classId){

        $cur_year= $sessionYearId;
        $stid=Auth::guard('student')->user()->id;
        $feeid=DB::table('fee_collections')->select('feeId')
        ->where('studentId', Auth::guard('student')->user()->id)
        ->where('sessionYearId', $cur_year)
        ->where('month', $month)->pluck('feeId');


        $NotGivenMonth=DB::table('fees')->select('*')
        ->whereNotIn('id', $feeid)
        ->where('interval', 'monthly')
        ->where('classId', $classId)
        ->get();


        //Check which month, this student do not pay their fee==(Monthly Un-paid Fees)
        $totalNotGiven=Fee::whereNotIn('id', $feeid)
        ->where('interval', 'monthly')
        ->where('classId', $classId)
        ->sum('amount');
        $tableOut="";
        foreach ($NotGivenMonth as $notGive) {
            $tableOut.='<tr>'.
            '<td>'.$notGive->name.'</td>'.
            '<td>'.$notGive->amount.'</td>'.
            '</tr>';
        }
        //feeCollection query and check which month this specific student do not fee pay
        $monthlyFeeid=DB::table('fees')->select('id')->where('sessionYearId', $cur_year)->where('interval', 'monthly')->where('classId', $classId)->pluck('id');
        $dueFeeByMonth=feeCollection::where('due','>',0)->where('studentId', Auth::guard('student')->user()->id)
        ->where('month',$month)
        ->whereIn('feeId', $monthlyFeeid)

        ->get();
        //Total due check of feeCollection table
        $totalDueByMonth=feeCollection::where('due','>',0)->where('studentId', Auth::guard('student')->user()->id)
        ->where('month',$month)
        ->whereIn('feeId', $monthlyFeeid)
        //->where('classId', $classId)
        ->sum('due');
        $HTMLdueFeeByMonth="";
        foreach ($dueFeeByMonth as $dueFee) {
            $HTMLdueFeeByMonth.='<tr>'.
            '<td>'.$dueFee->Fee->name.'</td>'.
            '<td>'.$dueFee->amount.'</td>'.
            '<td>'.$dueFee->totalAmount.'</td>'.
            '<td>'.$dueFee->due.'</td>'.
            '</tr>';
        }
        //From the fee_collections table's studentId
        $yearlyfeeid=DB::table('fee_collections')->select('feeId')->where('studentId', Auth::guard('student')->user()->id)->where('sessionYearId', $cur_year)->pluck('feeId');

        //Yearly unpaid fess
        $yearlyUnPaidFees=DB::table('fees')->select('*')
        ->whereNotIn('id', $yearlyfeeid)
        ->where('interval', 'yearly')
        ->where('classId', $classId)
        ->get();
        $totalyearlyUnPaidFees=Fee::whereNotIn('id', $yearlyfeeid)
        ->where('interval', 'yearly')
        ->where('classId', $classId)
        ->sum('amount');
        $yearlyUnPaidHTML="";
        foreach ($yearlyUnPaidFees as $yearlyUnPaidFee) {
            $yearlyUnPaidHTML.='<tr>'.
            '<td>'.$yearlyUnPaidFee->name.'</td>'.
            '<td>'.$yearlyUnPaidFee->amount.'</td>'.
            '</tr>';
        }
        //yearly student's due fees
        $yearlyFeeid=DB::table('fees')->select('id')->where('sessionYearId', $cur_year)->where('interval', 'yearly')->pluck('id');
        $yearlyDueFees=feeCollection::where('due','>',0)->where('studentId', Auth::guard('student')->user()->id)
        ->where('sessionYearId', $cur_year)
        ->whereIn('feeId', $yearlyFeeid)
        ->get();
        //Total yearly due check of feeCollection table
        $totalDueByYear=feeCollection::where('due','>',0)->where('studentId', Auth::guard('student')->user()->id)
        ->where('sessionYearId', $cur_year)
        ->whereIn('feeId', $yearlyFeeid)
        ->sum('due');
        $yearlyDuFeeHTML="";
        foreach ($yearlyDueFees as $yearlyDueFee) {
            $yearlyDuFeeHTML.='<tr>'.
            '<td>'.$yearlyDueFee->Fee->name.'</td>'.
            '<td>'.$yearlyDueFee->amount.'</td>'.
            '<td>'.$yearlyDueFee->totalAmount.'</td>'.
            '<td>'.$yearlyDueFee->due.'</td>'.
            '</tr>';
        }

        // $totalDueByMonth=feeCollection::where('due','>',0)->where('studentId', Auth::guard('student')->user()->id)
        // ->where('month',$month)
        // ->sum('due');
        return Response()->json(["tableOut"=>$tableOut, 'totalNotGiven'=>$totalNotGiven,'dueFeeByMonth'=>$HTMLdueFeeByMonth, "totalDueByMonth"=>$totalDueByMonth, "yearlyUnPaidHTML"=>$yearlyUnPaidHTML, "totalyearlyUnPaidFees"=>$totalyearlyUnPaidFees, "yearlyDueFees"=>$yearlyDuFeeHTML,"totalDueByYear"=>$totalDueByYear]);
        // // dd($feeid);
        // $monthList=month::get()->pluck('month');

        // // $NotGivenMonth=DB::table('months')->select('month')
        // // ->whereNotIn('month', function($month){
        // //     $month->select('month')->from('fee_collections')->where('id', Auth::guard('student')->user()->id);
        // // })->get()->pluck('month');
        // $givenMonth=month::with('feeCollections')->get();
        // // foreach($givenMonth as $gv){
        // //     foreach($gv->feeCollections as $cl){
        // //         echo($cl->feeId)."<br/>";
        // //     };
        // // };
        // return view('backend.student.pages.fee.studentDueFees', compact('givenMonth'));
    }
    //Unpaid Fee


    //

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\model\studentFee  $studentFee
     * @return \Illuminate\Http\Response
     */
    public function edit( $studentFee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\model\studentFee  $studentFee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $studentFee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\model\studentFee  $studentFee
     * @return \Illuminate\Http\Response
     */
    public function destroy( $studentFee)
    {
        //
    }
}
