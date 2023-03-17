<?php

namespace App\Http\Controllers\backend;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

use App\model\classes;
use App\model\Student;
use App\model\Section;
use App\model\SessionYear;

use App\model\studentScholarship;

use App\model\Fee;
use App\model\feeCollection;
use App\model\feeHistory;
use App\model\dueFeeHistory;
use Illuminate\Support\Facades\Route;





class FeeCollectionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
        $class=classes::where('bid', Auth::guard('web')->user()->bId)->get();
        $fees=Fee::where('bid', Auth::guard('web')->user()->bId)->get();
        $section=Section::where('bid', Auth::guard('web')->user()->bId)->get();
        $sessionYear= SessionYear::where('bId', Auth::guard('web')->user()->bId)->get();
        return view('backend.pages.fee.feeCollection')->with('class', $class)->with('section', $section)->with('sessionYear',$sessionYear)->with('fees',$fees);
    }

    //studentFeeDetails
    public function studentFeeDetails(){
        $class=classes::where('bid', Auth::guard('web')->user()->bId)->get();
        $fees=Fee::where('bid', Auth::guard('web')->user()->bId)->get();
        $section=Section::where('bid', Auth::guard('web')->user()->bId)->get();
        $sessionYear= SessionYear::where('bId', Auth::guard('web')->user()->bId)->get();
        return view('backend.pages.fee.studentFeeDetails')->with('class', $class)->with('section', $section)->with('sessionYear',$sessionYear)->with('fees',$fees);
    }

    //Check individual fee collection
    public function individualFeeDetails(Request $request)
    {
        $sectionId= $request->sectionId;
            $students = Student::where('sectionId',$sectionId)
            ->where('bId', Auth::guard('web')->user()->bId)
            ->get();
            return response()->json($students);
    }

    //Students Individual due fees are show
    public function dueDetailsFee($month,$studentId,$sessionYearId,$classId){
        //Monthly paied
        //$cur_year=date('Y');
        $cur_year=$sessionYearId;

        //feeCollection query by studentId & month
        $feeCollection=feeCollection::orderBy('id','DESC')
        ->where('studentId', $studentId)
        ->where('sessionYearId', $cur_year)
        ->where('month',$month)
        ->with('Fee')->get();

        //feeCollection query by studentId & check their month & total fee paied
        $totalAmountPay=feeCollection::where('studentId', $studentId)
         ->where('sessionYearId', $cur_year)
        ->where('month',$month)
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

        //$stid=Auth::guard('student')->user()->id;
        $feeid=DB::table('fee_collections')->select('feeId')->where('studentId', $studentId)->where('sessionYearId', $cur_year)->where('month', $month)->pluck('feeId');
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

        //feeCollection query and check which month this specific student do not fee their pay
        $monthlyFeeid=DB::table('fees')->select('id')->where('sessionYearId', $cur_year)->where('interval', 'monthly')->pluck('id');
        $dueFeeByMonth=feeCollection::where('due','>',0)->where('studentId', $studentId)
        ->where('month',$month)
        ->whereIn('feeId', $monthlyFeeid)
        ->get();
        //Total due check of feeCollection table
        $totalDueByMonth=feeCollection::where('due','>',0)->where('studentId',$studentId)
        ->where('month',$month)
        ->whereIn('feeId', $monthlyFeeid)
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
        $yearlyfeeid=DB::table('fee_collections')->select('feeId')->where('studentId',$studentId)->where('sessionYearId', $cur_year)->pluck('feeId');

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
        $yearlyDueFees=feeCollection::where('due','>',0)->where('studentId',$studentId)
        ->where('sessionYearId', $cur_year)
        ->whereIn('feeId', $yearlyFeeid)
        ->get();
        //Total yearly due check of feeCollection table
        $totalDueByYear=feeCollection::where('due','>',0)->where('studentId',$studentId)
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
        return Response()->json(["totalAmountPay"=>$totalAmountPay, "tableOutPut"=>$tableOutPut,"tableOut"=>$tableOut, 'totalNotGiven'=>$totalNotGiven,'dueFeeByMonth'=>$HTMLdueFeeByMonth, "totalDueByMonth"=>$totalDueByMonth, "yearlyUnPaidHTML"=>$yearlyUnPaidHTML, "totalyearlyUnPaidFees"=>$totalyearlyUnPaidFees, "yearlyDueFees"=>$yearlyDuFeeHTML,"totalDueByYear"=>$totalDueByYear]);
    }

    //individual fee page
    public function individualCollection()

    {
        $class=classes::where('bid', Auth::guard('web')->user()->bId)->get();
        $fees=Fee::where('bid', Auth::guard('web')->user()->bId)->get();
        $section=Section::where('bid', Auth::guard('web')->user()->bId)->get();
        $sessionYear= SessionYear::where('bId', Auth::guard('web')->user()->bId)->get();
        return view('backend.pages.fee.individualFeeCollection')->with('class', $class)->with('section', $section)->with('sessionYear',$sessionYear)->with('fees',$fees);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    //for morethen one month index
    public function monthlyindex()

    {
        $class=classes::where('bid', Auth::guard('web')->user()->bId)->get();
        $fees=Fee::where('bid', Auth::guard('web')->user()->bId)->get();
        $section=Section::where('bid', Auth::guard('web')->user()->bId)->get();
        $sessionYear= SessionYear::where('bId', Auth::guard('web')->user()->bId)->get();
        return view('backend.pages.fee.individualFeeForMultipalMonth')->with('class', $class)->with('section', $section)->with('sessionYear',$sessionYear)->with('fees',$fees);
    }



    //Advance feecollection //findMonth
    public function findMonth(Request $request){

        $bId=Auth::guard('web')->user()->bId;
        $feeId=$request->feeId;
        $studentId=$request->studentId;
        $sessionYear=$request->sessionYear;
        //check fee type
        // $feType=Fee::findOrFail($feeId);
        // if($feType->interval=='yearly'){



        // }else{

        $month=DB::select("select month from months where month NOT IN(select fee_collections.month from
        fee_collections where fee_collections.bId='$bId'
        AND fee_collections.feeId='$feeId'
        and fee_collections.studentId='$studentId'
        AND fee_collections.sessionYearId='$sessionYear')");

        return response()->json($month);
       // }

    }



    //find student list for individual fee section
    public function individualStudent(Request $request)
    {
        $sectionId= $request->sectionId;
            $students = Student::where('sectionId',$sectionId)
            ->where('bId', Auth::guard('web')->user()->bId)
            ->get();
            return response()->json($students);
    }

    // find student for individual section
    public function individualStudent2(Request $request)
    {
        $sectionId= $request->sectionId;
        $studentId= $request->studentId;
            $student = Student::where('sectionId',$sectionId)->where('id',$studentId)
            ->where('bId', Auth::guard('web')->user()->bId)
            ->get();

        return response()->json($student);
    }

    //Advance fee collection
    public function findMonthForAdvancefeeCollection(Request $request)
    {
        $feeId=$request->feeId;
        $studentId=$request->studentId;
        $amount=$request->amount;
        $type=$request->type;
        $sessionYear=$request->sessionYear;
        $bId=Auth::guard('web')->user()->bId;


         $scholership= studentScholarship::where('studentId',$studentId)->where('feeId',$feeId)->get();


        $discount=0;
        if($scholership){
            foreach ($scholership as $sc) {
                $discount= $sc->discount;
                }
                $paidAmount =  $amount-(($amount*$discount)/100);
                $discountAmount= ($amount*$discount)/100;
                $discountPercentAge=$discount;
        }
        if($type=='yearly'){
            //return($type);

            $feeCollection=feeCollection::where('feeId',$feeId)
            ->where('sessionYearId',$sessionYear)
            ->where('studentId',$request->studentId)
            ->where('bId' , Auth::guard('web')->user()->bId)
            ->count();
            //return($feeCollection);
            if($feeCollection>0){
                return Response()->json(["paidAmount"=>$paidAmount, "discountAmount"=>$discountAmount,"percentage"=>$discountPercentAge, "yearlypayment"=>"already taken"]);

            }else{
                $yearlypayment="";
                $yearlypayment.='<tr>'.
                '<td>'.'<input type="checkbox" name="month['.strtoupper(date('F')).']" value="month['.strtoupper(date('F')).']" readonly>'.'</td>'.
                '<td>'.strtoupper(date('F')).'</td>'.
                '</tr>';

                return Response()->json(["paidAmount"=>$paidAmount, "discountAmount"=>$discountAmount,"percentage"=>$discountPercentAge, "yearlypayment"=>$yearlypayment]);
            }

        }else{

        $month=DB::select("select month from months where month NOT IN(select fee_collections.month from
        fee_collections where fee_collections.bId='$bId'
        AND fee_collections.feeId='$feeId'
        and fee_collections.studentId='$studentId'
        AND fee_collections.sessionYearId='$sessionYear')");
        return response()->json(["paidAmount"=>$paidAmount, "discountAmount"=>$discountAmount,"percentage"=>$discountPercentAge,"month"=>$month]);

        }
    }

    //for individual student page find student fee
    public function individualStudentfind(Request $request)
    {
        $feeId=$request->feeId;
        $studentId=$request->studentId;
        $amount=$request->amount;
        $type=$request->type;
        $sessionYear=$request->sessionYear;
        $bId=Auth::guard('web')->user()->bId;
        //return($amount);

         $scholership= studentScholarship::where('studentId',$studentId)->where('feeId',$feeId)->get();
        //return($scholership);

        $discount=0;
        if($scholership){
            foreach ($scholership as $sc) {
                $discount= $sc->discount;
                }
                $paidAmount =  $amount-(($amount*$discount)/100);
                $discountAmount= ($amount*$discount)/100;
                $discountPercentAge=$discount;
                //return($discountAmount);


                //return response()->json(["paidAmount"=>$paidAmount, "discountAmount"=>$discountAmount,"percentage"=>$discountPercentAge]);
        }

        //individual student find form feeCollection
        $feeCollection=feeCollection::where('sectionId', $request->sectionId)
        ->where('feeId',$request->feeId)
        ->where('month',$request->month)
        ->where('studentId',$request->studentId)
        ->where('bId' , Auth::guard('web')->user()->bId)
        ->count();

        if($feeCollection>0){

            $Stfees=feeCollection::where('sectionId', $request->sectionId)
            ->where('feeId',$request->feeId)
            ->where('month',$request->month)
            ->where('studentId',$request->studentId)
            ->where('bId' , Auth::guard('web')->user()->bId)
            ->with('Fee')
            ->get();

            $output="";
            foreach ($Stfees as $Stfee) {
                $output.='<tr>'.

                    '<td>'.$Stfee->Fee->name.'</td>'.
                    '<td>'.$Stfee->Fee->type.'</td>'.
                    '<td>'.$Stfee->amount.'</td>'.
                    '<td>'.'<input type="number" id="newDue" name="newDue" value="'.$Stfee->due.'" readonly>'.'</td>'.
                    '<td>'.'<input type="number" name="originalTotalAmount" value="'.$Stfee->totalAmount.'" readonly>'.'+'.'<input type="number" name="inputAmount" id="inputAmount" value="0" min="0" max="'.$Stfee->due.'" required >'.'</td>'.
                    '<td>'.$Stfee->created_at->format('d-M-Y').'</td>'.
                    '</tr>';
            }
            return Response()->json(["outPut"=>$output, "Stfees"=>$Stfees,"paidAmount"=>$paidAmount, "discountAmount"=>$discountAmount,"percentage"=>$discountPercentAge]);

        }else{

            $TakeStfees=Fee::where('id', $request->feeId)
            ->where('classId',$request->classId)
            ->where('bId' , Auth::guard('web')->user()->bId)
            ->get();

            $feeoutput="";

            foreach ($TakeStfees as $Stfee) {
                $feeoutput.='<tr>'.
                '<td>'.$Stfee->name.'</td>'.
                '<td>'.$Stfee->type.'</td>'.
                '<td>'.$Stfee->amount.'</td>'.
                '<td>'.'<input type="number" name="due" value="0" min="0"  readonly >'.'</td>'.
                '<td>'.'<input type="number" name="totalAmount" min="0" id="totalAmount" max="0">'.'</td>'.
                '<td>'.date('d-M-Y').'</td>'.

                '</tr>';
            }
            return Response()->json(["Fee"=>$feeoutput, "paidAmount"=>$paidAmount, "discountAmount"=>$discountAmount,"percentage"=>$discountPercentAge]);

            }

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //find student for group fee collection
    public function student(Request $request)
    {

        $fee=feeCollection::where('sectionId', $request->sectionId)
         ->where('feeId',$request->feeId)
         ->where('month',$request->month)
         ->where('sessionYearId',$request->sessionYear)
         ->where('bId' , Auth::guard('web')->user()->bId)
         ->first();

        if($fee!=null){

            $bId=Auth::guard('web')->user()->bId;
            $feeId=$request->feeId;
            $month=$request->month;
            $sectionId=$request->sectionId;
            $sessionYear=$request->sessionYear;

            $dueStudent=DB::select("select students.id,students.firstName,students.lastName,students.roll from
            students where  students.id NOT IN(select fee_collections.studentId from fee_collections
            where fee_collections.bId='$bId'
            and fee_collections.feeId='$feeId'
            and fee_collections.month='$month'
            And fee_collections.sectionId='$sectionId'
            and fee_collections.sessionYearId='$sessionYear')

            AND students.sectionId='$sectionId'
            AND students.bId='$bId'
            AND students.deleted_at IS NULL
            ");

            $paidStudent=DB::select("select fee_collections.id,students.id,students.firstName,students.lastName,students.roll from
            students,fee_collections where fee_collections.studentId=students.id
            and fee_collections.sectionId='$request->sectionId'
            and fee_collections.feeId='$feeId'
            and fee_collections.bId='$bId'
            and fee_collections.month='$month'
            and fee_collections.sessionYearId='$sessionYear'");

            return response()->json(["dueStudent"=>$dueStudent, "paidStudent"=>$paidStudent]);
        }else{
            $sectionId= $request->sectionId;
            $students = Student::where('sectionId',$sectionId)->get();
            return response()->json($students);
         }
    }

    // store feeCollection data in group
    public function store(Request $request)
    {

        $fee= $request->studentId;
        foreach ($fee as $id =>$value) {
            $stfee = new feeCollection();
            $fee= $request->amount2;
            $stfee->feeId = $request->feeId2;
            $stfee->month = $request->month2;
            $stfee->paidMonth = strtoupper(date('F'));
            $stfee->sessionYearId = $request->sessionYear2;
            $stfee->sectionId = $request->sectionId;
            $stfee->amount  = $fee;

            //change for total amount
            if($id!=null){
                $scholership= studentScholarship::where('studentId',$id)->where('feeId',$request->feeId2)->get();
                $discount=0;
                if($scholership){
                    foreach ($scholership as $sc) {
                        $discount= $sc->discount;

                        }
                        $totalAmount =  $fee-(($fee*$discount)/100);

                        $stfee->totalAmount  = $totalAmount;
                        $stfee->studentId = $id;
                }
            }
            $stfee->bId= Auth::user()->bId;
            $stfee->save();
        }
        Session::flash('success','Succesfully Data Saved');
        return redirect()->route('feecollection.index');
    }

    //store fee collection for individual
    public function storeIndividualy(Request $request)
    {
        $stindifee = new feeCollection();
        $fee= $request->amount2;

        $stindifee->feeId = $request->feeId2;
        $stindifee->amount = $fee;
        $stindifee->month = $request->month2;
        $stindifee->paidMonth = strtoupper(date('F'));
        $stindifee->sessionYearId = $request->sessionYear2;
        $stindifee->sectionId = $request->sectionId;
        $stindifee->studentId = $request->studentId2;
        $stindifee->totalAmount = $request->totalAmount;

        //find due Amount
        $due= ($fee-$request->totalAmount)-($request->discount2);
        // return($due);
        // dd($stindifee);

        $stindifee->due = $due;
        $stindifee->bId= Auth::user()->bId;
        //dd($stindifee);

        $stindifee->save();

        Session::flash('success','Succesfully Saved Student Fee Data');
        return redirect()->route('individualFee.individualCollection');
    }

    public function storeMorethenOneMonth(Request $request)
    {
        //return($request);
        $month= $request->month;
        foreach ($month as $id =>$value) {
            $stfee = new feeCollection();


            $stfee->feeId = $request->feeId2;
            $stfee->paidMonth = strtoupper(date('F'));
            $stfee->sessionYearId = $request->sessionYear2;
            $stfee->sectionId = $request->sectionId;
            $stfee->amount  = $request->amount2;
            $stfee->totalAmount  = $request->totalCharge2;
            $stfee->studentId = $request->studentId2;
            $stfee->month = $id;




            //change for total amount
            // if($id!=null){
            //     $scholership= studentScholarship::where('studentId',$id)->where('feeId',$request->feeId2)->get();
            //     $discount=0;
            //     if($scholership){
            //         foreach ($scholership as $sc) {
            //             $discount= $sc->discount;

            //             }
            //             $totalAmount =  $fee-(($fee*$discount)/100);

            //             $stfee->totalAmount  = $totalAmount;
            //             $stfee->studentId = $id;
            //     }
            // }
            $stfee->bId= Auth::user()->bId;

            //return($stfee);
            $stfee->save();
        }
        Session::flash('success','Succesfully Data Saved');
        return redirect()->route('monthly.index');
        //return redirect()->url()->previous();
        //echo url()->previous();
    }

    //scholership and discount amount for individual student
    // public function scholarshipAmount(Request $request)
    // {
    //     $feeId=$request->feeId;
    //     $studentId=$request->studentId;
    //     $amount=$request->amount;
    //     //return($amount);

    //      $scholership= studentScholarship::where('studentId',$studentId)->where('feeId',$feeId)->get();
    //     //return($scholership);

    //     $discount=0;
    //     if($scholership){
    //         foreach ($scholership as $sc) {
    //             $discount= $sc->discount;
    //             }
    //             $paidAmount =  $amount-(($amount*$discount)/100);
    //             $discountAmount= ($amount*$discount)/100;
    //             $discountPercentAge=$discount;
    //             //return($discountAmount);

    //         return response()->json(["paidAmount"=>$paidAmount, "discountAmount"=>$discountAmount,"percentage"=>$discountPercentAge]);

    //     }
    // }
    /**
     * Display the specified resource.
     *
     * @param  \App\model\feeCollection  $feeCollection
     * @return \Illuminate\Http\Response
     */
    public function show(feeCollection $feeCollection)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\model\feeCollection  $feeCollection
     * @return \Illuminate\Http\Response
     */
    public function edit(feeCollection $feeCollection)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\model\feeCollection  $feeCollection
     * @return \Illuminate\Http\Response
     */

    //feeCollection Group data
    public function update(Request $request, feeCollection $feeCollection)
    {
        //dd($request);
        $stid=$request->studentId ;
        //$deleteStudent=$stid=$request->studentId ;
        //dd($deleteStudent);

        if($stid<1){
            $stid=array("0");


        }else{
            $stid=$stid;
            //dd($stid);
        }
        //$ids = explode(',', $ids);

     //dd($stid);
        //$stid=$stid->toSql();
        //$stid=$stid;

        $deleteStudent= DB::table('fee_collections')
                        ->where('month',$request->month2)
                        ->where('bId', Auth::user()->bId)
                        ->where('sessionYearId',$request->sessionYear2)
                        ->where('feeId',$request->feeId2)
                        ->whereNotIn('studentId',$stid)
                       ->pluck('studentId');
                        //->get();
        //request($deleteStudent);
         if($deleteStudent){
            DB::table('fee_collections')
            ->where('month',$request->month2)
            ->where('bId', Auth::user()->bId)
            ->where('sessionYearId',$request->sessionYear2)
            ->where('feeId',$request->feeId2)
            ->whereIn('studentId', $deleteStudent)->delete();

            Session::flash('success','Unchecked Student Removed From Fee Collection');
            return redirect()->route('feecollection.index');
        }



    }

    //for invididual update in fee Collection
    public function updateIndividualStudent(Request $request)
    {
        //return($request);
        $individualFeeStudent = feeCollection::where('studentId',$request->studentId2)
                                ->where('feeId',$request->feeId2)
                                ->where('month',$request->month2)
                                ->where('sessionYearId',$request->sessionYear2)
                                ->where('sectionId',$request->sectionId)
                                ->where('bId',Auth::user()->bId)
                                ->firstOrFail();

        //return($individualFeeStudent);
        //return($individualFeeStudent->id);

        if( $individualFeeStudent ){
            //return('working');
            $feeCollectionId = $individualFeeStudent->id;

            $individualFeeStudent->amount = $request->amount2;
            $individualFeeStudent->paidMonth = strtoupper(date('F'));

            $due= ($request->newDue-$request->inputAmount);

            //16-1-2020 change for due fee calculation
            //$totalAmount=($request->originalTotalAmount+$request->inputAmount);

            if($request->inputAmount>0){
            //return('active due fee history');

                $dueFeeHistory= new dueFeeHistory();

                $dueFeeHistory->feeCollectionId =  $feeCollectionId;
                $dueFeeHistory->due =$request->newDue;
                $dueFeeHistory->PreviousPaidAmount =$request->originalTotalAmount;
                $dueFeeHistory->paidAmount =$request->inputAmount;
                $dueFeeHistory->sectionId =$request->sectionId;
                $dueFeeHistory->paidMonth =strtoupper(date('F'));
                $dueFeeHistory->bId= Auth::user()->bId;

                $dueFeeHistory->save();
                //return("fee history saved");
            }

            $individualFeeStudent->due =$due;

            //16-1-2020 change for due fee calculation
            //$individualFeeStudent->totalAmount =$totalAmount;
            $individualFeeStudent->save();

            Session::flash('success','Student Fee Date Succesfully Updated with Due history');
            return redirect()->route('individualFee.individualCollection');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\model\feeCollection  $feeCollection
     * @return \Illuminate\Http\Response
     */
    public function destroy(feeCollection $feeCollection)
    {
        // $sessionYearDelete = SessionYear::find($id);
        //if($sessionYearDelete){
          //  $sessionYearDelete->delete();
            //return response()->json(["success"=>'Data successfully Deleted',201]);
    }

    //Fee collection Payment Section
    public function payment(){
        $class=classes::where('bid', Auth::guard('web')->user()->bId)->get();
        $fees=Fee::where('bid', Auth::guard('web')->user()->bId)->get();
        $section=Section::where('bid', Auth::guard('web')->user()->bId)->get();
        $sessionYear= SessionYear::where('bId', Auth::guard('web')->user()->bId)->get();
        return view('backend.pages.fee.payment')->with('class', $class)->with('section', $section)->with('sessionYear',$sessionYear)->with('fees',$fees);
    }

        //Students Individual due fees are show
        public function paymentDetailsFee($month,$studentId,$sessionYearId,$classId){
            //Monthly paied
            //$cur_year=date('Y');
            $cur_year=$sessionYearId;

            //feeCollection query by studentId & month
            $feeCollection=feeCollection::orderBy('id','DESC')
            ->where('studentId', $studentId)
            ->where('sessionYearId', $cur_year)
            ->where('month',$month)
            ->with('Fee')->get();

            //feeCollection query by studentId & check their month & total fee paied
            $totalAmountPay=feeCollection::where('studentId', $studentId)
             ->where('sessionYearId', $cur_year)
            ->where('month',$month)
            ->sum('totalAmount');


            $tableOutPut="";
            foreach ($feeCollection as $fcollection) {
                $tableOutPut.='<tr>'.
                '<td>'.$fcollection->DT_RowIndex."#".'</td>'.
                '<td>'.$fcollection->created_at->format('d-M-Y').'</td>'.
                '<td>'.$fcollection->month.'</td>'.
                '<td>'.$fcollection->Fee->name.'</td>'.
                '<td>'.$fcollection->Fee->type.'</td>'.
                '<td>'.$fcollection->totalAmount.'</td>'.
                '</tr>';
            }

            //$stid=Auth::guard('student')->user()->id;
            $feeid=DB::table('fee_collections')->select('feeId')->where('studentId', $studentId)->where('sessionYearId', $cur_year)->where('month', $month)->pluck('feeId');
            $NotGivenMonth=DB::table('fees')->select('*')
            ->whereNotIn('id', $feeid)
            //->where('interval', 'monthly')
            ->where('classId', $classId)
            ->orderBy('name', 'DESC')
            ->get();

            //Check which month, this student do not pay their fee==(Monthly Un-paid Fees)
            $totalNotGiven=Fee::whereNotIn('id', $feeid)
            //->where('interval', 'monthly')
            ->where('classId', $classId)
            ->sum('amount');
            $tableOut="";
            foreach ($NotGivenMonth as $notGive) {
                $tableOut.='<tr>'.

                "<td>".'<input class="roll" type="checkbox" name="month['.$notGive->id.']" value="month['.$notGive->id.']">'."</td>".
                '<td>'.$notGive->name.'</td>'.
                '<td>'.$notGive->interval.'</td>'.
                '<td>'.$notGive->amount.'</td>'.
                '</tr>';
            }

            // //feeCollection query and check which month this specific student do not fee their pay
            // $monthlyFeeid=DB::table('fees')->select('id')->where('sessionYearId', $cur_year)->where('interval', 'monthly')->pluck('id');
            // $dueFeeByMonth=feeCollection::where('due','>',0)->where('studentId', $studentId)
            // ->where('month',$month)
            // ->whereIn('feeId', $monthlyFeeid)
            // ->get();
            // //Total due check of feeCollection table
            // $totalDueByMonth=feeCollection::where('due','>',0)->where('studentId',$studentId)
            // ->where('month',$month)
            // ->whereIn('feeId', $monthlyFeeid)
            // ->sum('due');
            // $HTMLdueFeeByMonth="";
            // foreach ($dueFeeByMonth as $dueFee) {
            //     $HTMLdueFeeByMonth.='<tr>'.
            //     '<td>'.$dueFee->Fee->name.'</td>'.
            //     '<td>'.$dueFee->amount.'</td>'.
            //     '<td>'.$dueFee->totalAmount.'</td>'.
            //     '<td>'.$dueFee->due.'</td>'.
            //     '</tr>';
            // }

            // //From the fee_collections table's studentId
            // $yearlyfeeid=DB::table('fee_collections')->select('feeId')->where('studentId',$studentId)->where('sessionYearId', $cur_year)->pluck('feeId');

            // //Yearly unpaid fess
            // $yearlyUnPaidFees=DB::table('fees')->select('*')
            // ->whereNotIn('id', $yearlyfeeid)
            // ->where('interval', 'yearly')
            // ->where('classId', $classId)
            // ->get();
            // $totalyearlyUnPaidFees=Fee::whereNotIn('id', $yearlyfeeid)
            // ->where('interval', 'yearly')
            // ->where('classId', $classId)
            // ->sum('amount');
            // $yearlyUnPaidHTML="";
            // foreach ($yearlyUnPaidFees as $yearlyUnPaidFee) {
            //     $yearlyUnPaidHTML.='<tr>'.
            //     '<td>'.$yearlyUnPaidFee->name.'</td>'.
            //     '<td>'.$yearlyUnPaidFee->amount.'</td>'.
            //     '</tr>';
            // }

            // //yearly student's due fees
            // $yearlyFeeid=DB::table('fees')->select('id')->where('sessionYearId', $cur_year)->where('interval', 'yearly')->pluck('id');
            // $yearlyDueFees=feeCollection::where('due','>',0)->where('studentId',$studentId)
            // ->where('sessionYearId', $cur_year)
            // ->whereIn('feeId', $yearlyFeeid)
            // ->get();
            // //Total yearly due check of feeCollection table
            // $totalDueByYear=feeCollection::where('due','>',0)->where('studentId',$studentId)
            // ->where('sessionYearId', $cur_year)
            // ->whereIn('feeId', $yearlyFeeid)
            // ->sum('due');
            // $yearlyDuFeeHTML="";
            // foreach ($yearlyDueFees as $yearlyDueFee) {
            //     $yearlyDuFeeHTML.='<tr>'.
            //     '<td>'.$yearlyDueFee->Fee->name.'</td>'.
            //     '<td>'.$yearlyDueFee->amount.'</td>'.
            //     '<td>'.$yearlyDueFee->totalAmount.'</td>'.
            //     '<td>'.$yearlyDueFee->due.'</td>'.
            //     '</tr>';
            // }
           // return Response()->json(["totalAmountPay"=>$totalAmountPay, "tableOutPut"=>$tableOutPut,"tableOut"=>$tableOut, 'totalNotGiven'=>$totalNotGiven,'dueFeeByMonth'=>$HTMLdueFeeByMonth, "totalDueByMonth"=>$totalDueByMonth, "yearlyUnPaidHTML"=>$yearlyUnPaidHTML, "totalyearlyUnPaidFees"=>$totalyearlyUnPaidFees, "yearlyDueFees"=>$yearlyDuFeeHTML,"totalDueByYear"=>$totalDueByYear]);
            return Response()->json(["totalAmountPay"=>$totalAmountPay, "tableOutPut"=>$tableOutPut,"tableOut"=>$tableOut, 'totalNotGiven'=>$totalNotGiven]);
        }
}
