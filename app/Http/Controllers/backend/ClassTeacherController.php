<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\SessionYear;
use App\model\classes;
use App\model\ClassTeacher;
use App\model\Section;
use App\model\Student;
use App\model\Attendance;
use App\model\feeCollection;
use App\Notification\multipleSmsService;
use Illuminate\Support\Facades\DB;
use App\model\studentScholarship;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class ClassTeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->multipleSmsService= new multipleSmsService();
    }

    public function myclassattendance()
    {
        $userId= Auth::guard('web')->user()->id;
        //dd($userId);
        $bId= Auth::guard('web')->user()->bId;
        //dd($bId);
        $teachers= ClassTeacher::where('userId',$userId)->where('bId',$bId)->with('Section')->count();
        //dd($teachers);
        if($teachers<=0){

             return "You are not enroled in any class";

        }else{

            $teachers= ClassTeacher::where('userId',$userId)->where('bId',$bId)->with('Section')->get();
            foreach($teachers as $teacher){
                    if($teacher->Section->sessionYear->status == 1){
                        //dd($teacher->Section);
                        $classId = $teacher->classId;
                        $sectionId = $teacher->sectionId;

                    return view('backend.pages.classTeacher.myclassAttendence',['sectionId'=>$sectionId,'classId'=>$classId ]);
                }else{
                    return redirect()->back()->with('Session Expired!. You are not enroled in any class');
                }
            }

        }

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
   //store Attendance information
public function storeAttendence(Request $request){

    // $validator= Validator::make($request->all(), Attendance::$rules);
       // if ($validator->fails()) {
       //     return $validator->errors();
       //     // Session::flash('','Succesfully Student Attendence Data Saved');
       // }else{
           $attendence= $request->attend;
           $absentStudentId[]=0;
           foreach ($attendence as $id => $value) {
            if ($value=="absent") {
                $absentStudentId[]=$id;
            }
               $stAttendence = new Attendance();
               $stAttendence->attendence = $value;
               $stAttendence->sectionId = $request->sectionId;
               $stAttendence->classId = $request->classId2;
               $stAttendence->studentId = $id;
               if($request->created_date !=null){
                   $stAttendence->created_at=$request->created_date;
               }
               $stAttendence->bId= Auth::user()->bId;
               $stAttendence->save();
           }
           $absentStudentDetailes=Student::whereIn('id', $absentStudentId)->with('Section')->get();
           if(count($absentStudentDetailes)>0){
           
            foreach($absentStudentDetailes as $value){
                $msgAndContact[]=array(
                    "to"=>$value->mobile,
                    "message"=>"Honorable guardian, your son/daughter ".$value->firstName." ".$value->lastName.",Class ".$value->Section->classes->className.",Section ".$value->Section->sectionName.", Roll ". $value->roll. " is absent on ".$stAttendence->created_at->toDateString()." Thank You."
                );
                }
                $notifyBy= $this->multipleSmsService;
                $notifyBy->notification("dfas", $msgAndContact);
             }
           Session::flash('success','Succesfully Saved Student Attendence Data ');
           $attendences=Attendance::orderBy('id','ASC')->get();

            if((url()->previous())!==(url('/myclass/attendance'))){

            return redirect()->route('myclass.attendancebydate');

            }else{

            return redirect()->route('myclass.attendance');

            }

       }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   //find current date attendance
   public function edit( $sectionId){

    $attendences=Attendance::whereDate('created_at',date('Y-m-d'))->where('sectionId', $sectionId)->where('bId', Auth::user()->bId)->with('section', 'student')->get();
    // foreach($attendences as $attn){
    //     foreach($attn->section->student as $stn){
    //         dd($stn->firstName);
    //     }
    // }

    return view('backend.pages.classTeacher.updateAttendence')->with('attendences', $attendences);
    //return Response()->json($attendence);
}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   //update student attendence
   public function update(Request $request){

    $attendence= $request->attend;
    foreach ($attendence as $id => $value) {
    $stAttendence = Attendance::find($id);
    $stAttendence->attendence = $value;
    $stAttendence->bId= Auth::guard('web')->user()->bId;
    $stAttendence->update();
    }

    Session::flash('success','Successfully Updated The Attendence');
    return redirect()->back();
}
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    //FeeCollection section
    public function myclassfeecollection()
    {
        $userId= Auth::guard('web')->user()->id;
        //dd($userId);
        $bId= Auth::guard('web')->user()->bId;
        //dd($bId);
        $teachers= ClassTeacher::where('userId',$userId)->where('bId',$bId)->with('Section')->count();
        //dd($teachers);
        if($teachers<=0){

             return "You are not enroled in any class";

        }else{

            $teachers= ClassTeacher::where('userId',$userId)->where('bId',$bId)->with('Section')->get();
            foreach($teachers as $teacher){
                    if($teacher->Section->sessionYear->status == 1){
                        //dd($teacher->Section);
                        $classId = $teacher->classId;
                        $shift = $teacher->shift;
                        $sessionYearId = $teacher->sessionYearId;
                        $sessionYear = SessionYear::where('id',$sessionYearId)->pluck('sessionYear');

                        $className= classes::where('id',$classId)->pluck('className');
                        $sectionId = $teacher->sectionId;
                        $sectionName= Section::where('id',$sectionId)->pluck('sectionName');

                    return view('backend.pages.classTeacher.feeCollection',['sectionId'=>$sectionId,'sectionName'=>$sectionName,'classId'=>$classId,'className'=>$className,'sessionYear'=>$sessionYear,'sessionYearId'=>$sessionYearId,'shift'=>$shift]);
                }else{
                    return redirect()->back()->with('Session Expired!. You are not enroled in any class');
                }
            }

        }

    }

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
    public function storefeecollection(Request $request)
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
        return redirect()->route('myclass.feecollection');
    }

     //feeCollection Group data
     public function updatefeecollection(Request $request, feeCollection $feeCollection)
     {
         //dd($request);
         $ids=$request->studentId ;
         if($ids<1){
             $ids=array("0");
         }
         //dd($ids);
         //$ids=$ids->toSql();
         //dd($ids);
         $deleteStudent= DB::table('fee_collections')
                         ->whereNotIn('studentId', $ids)  //not working
                         ->where('month',$request->month2)
                         ->where('bId', Auth::user()->bId)
                         ->where('sessionYearId',$request->sessionYear2)
                         ->where('feeId',$request->feeId2)
                         ->pluck('studentId');
         //dd($deleteStudent);
         if($deleteStudent){
             DB::table('fee_collections')
             ->where('month',$request->month2)
             ->where('bId', Auth::user()->bId)
             ->where('sessionYearId',$request->sessionYear2)
             ->where('feeId',$request->feeId2)
             ->whereIn('studentId', $deleteStudent)->delete();

             Session::flash('success','Unchecked Student Removed From Fee Collection');
             return redirect()->route('myclass.feecollection');
         }
     }


     // student list section
     public function studentlist()
     {
         $userId= Auth::guard('web')->user()->id;
         //dd($userId);
         $bId= Auth::guard('web')->user()->bId;
         //dd($bId);
         $teachers= ClassTeacher::where('userId',$userId)->where('bId',$bId)->with('Section')->count();
         //dd($teachers);
         if($teachers<=0){

              return "You are not enroled in any class";

         }else{

             $teachers= ClassTeacher::where('userId',$userId)->where('bId',$bId)->with('Section')->get();
             foreach($teachers as $teacher){
                     if($teacher->Section->sessionYear->status == 1){
                         //dd($teacher->Section);
                         $classId = $teacher->classId;
                         $shift = $teacher->shift;
                         $sessionYearId = $teacher->sessionYearId;
                         $sessionYear = SessionYear::where('id',$sessionYearId)->pluck('sessionYear');

                         $className= classes::where('id',$classId)->pluck('className');
                         $sectionId = $teacher->sectionId;
                         $sectionName= Section::where('id',$sectionId)->pluck('sectionName');

                     return view('backend.pages.classTeacher.studentlist',['sectionId'=>$sectionId,'sectionName'=>$sectionName,'classId'=>$classId,'className'=>$className,'sessionYear'=>$sessionYear,'sessionYearId'=>$sessionYearId,'shift'=>$shift]);
                 }else{
                     return redirect()->back()->with('Session Expired!. You are not enroled in any class');
                 }
             }

         }

     }

     public function sectionwiselist($classId,$sectionId,$sessionYearId)

     {

         $bId=Auth::guard('web')->user()->bId;
             $class=DB::select("select students.id as stdId, students.firstName,students.gender,students.religion, students.lastName, students.fatherName,students.motherName,students.roll, students.blood, students.birthDate,students.mobile
                                 from students, sections, classes
                                 WHERE sections.classId=classes.id
                                 AND students.sectionId=sections.id
                                 And classes.id='$classId'
                                 And sections.id='$sectionId'
                                 AND sections.sessionYearId='$sessionYearId'
                                 AND students.bId='$bId'");

                 $data_table_render = DataTables::of($class)

                         ->editColumn('firstName', function($student)
                           {
                              return $student->firstName. " ".$student->lastName;
                           })
                           ->addColumn('action',function ($student){

                             $edit_url = url('mystudent/show/studentProfile/'.$student->stdId);
                             return '<a href="'.$edit_url.'" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>'.
                             '<a  onClick="deleteStudent('.$student->stdId.')" class="btn btn-danger btn-sm delete_class"><i class="fa fa-trash-o"></i></a>';


                          })
                         ->rawColumns(['action'])
                         ->addIndexColumn()
                         ->make(true);
             return $data_table_render;
     }

     public function showstudentprofile($id)
     {
         $students=Student::with('schoolBranch','Section')
         ->where('bId', Auth::guard('web')->user()->bId)
         ->findOrFail($id);
         return view('backend.pages.mystudent.myStudentProfile',['students' => $students]);
     }


     public function studentdestroy($id)
    {
        $student = Student::find($id);
                if($student){
                    $student->delete();
                    return response()->json(["success"=>'Data Deleted',201]);
                }
            return response()->json(["error"=>'error',422]);
    }


    public function myclassattendancebydate()
    {
        $userId= Auth::guard('web')->user()->id;
        //dd($userId);
        $bId= Auth::guard('web')->user()->bId;
        //dd($bId);
        $teachers= ClassTeacher::where('userId',$userId)->where('bId',$bId)->with('Section')->count();
        //dd($teachers);
        if($teachers<=0){

             return "You are not enroled in any class";

        }else{

            $teachers= ClassTeacher::where('userId',$userId)->where('bId',$bId)->with('Section')->get();
            foreach($teachers as $teacher){
                    if($teacher->Section->sessionYear->status == 1){
                        //dd($teacher->Section);
                        $classId = $teacher->classId;
                        $sectionId = $teacher->sectionId;

                    return view('backend.pages.classTeacher.myclassAttendenceByDate',['sectionId'=>$sectionId,'classId'=>$classId ]);
                }else{
                    return redirect()->back()->with('Session Expired!. You are not enroled in any class');
                }
            }

        }

    }

        //FeeCollection section
        public function myclassIndividualFeeCollection()
        {
            $userId= Auth::guard('web')->user()->id;
            //dd($userId);
            $bId= Auth::guard('web')->user()->bId;
            //dd($bId);
            $teachers= ClassTeacher::where('userId',$userId)->where('bId',$bId)->with('Section')->count();
            //dd($teachers);
            if($teachers<=0){

                 return "You are not enroled in any class";

            }else{

                $teachers= ClassTeacher::where('userId',$userId)->where('bId',$bId)->with('Section')->get();
                foreach($teachers as $teacher){
                        if($teacher->Section->sessionYear->status == 1){
                            //dd($teacher->Section);
                            $classId = $teacher->classId;
                            $shift = $teacher->shift;
                            $sessionYearId = $teacher->sessionYearId;
                            $sessionYear = SessionYear::where('id',$sessionYearId)->pluck('sessionYear');

                            $className= classes::where('id',$classId)->pluck('className');
                            $sectionId = $teacher->sectionId;
                            $sectionName= Section::where('id',$sectionId)->pluck('sectionName');

                        return view('backend.pages.classTeacher.myclassIndividualFeeCollection',['sectionId'=>$sectionId,'sectionName'=>$sectionName,'classId'=>$classId,'className'=>$className,'sessionYear'=>$sessionYear,'sessionYearId'=>$sessionYearId,'shift'=>$shift]);
                    }else{
                        return redirect()->back()->with('Session Expired!. You are not enroled in any class');
                    }
                }

            }

        }


    public function myclassStoreMonthly(Request $request)
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
        return redirect()->route('myclass.feecollection.individual');
        //return redirect()->url()->previous();
        //echo url()->previous();
    }

         // student list section
         public function monthlyFeeReport()
         {
            $userId= Auth::guard('web')->user()->id;
             //dd($userId);
             $bId= Auth::guard('web')->user()->bId;
             //dd($bId);
             $teachers= ClassTeacher::where('userId',$userId)->where('bId',$bId)->with('Section')->count();
             //dd($teachers);
             if($teachers<=0){

                  return "You are not enroled in any class";

             }else{

                 $teachers= ClassTeacher::where('userId',$userId)->where('bId',$bId)->with('Section')->get();
                 foreach($teachers as $teacher){
                         if($teacher->Section->sessionYear->status == 1){
                             //dd($teacher->Section);
                             $classId = $teacher->classId;
                             //$shift = $teacher->shift;
                             $sessionYearId = $teacher->sessionYearId;
                             $sessionYear = SessionYear::where('id',$sessionYearId)->get();


                             $sectionId = $teacher->sectionId;


                         return view('backend.pages.classTeacher.myClassMonthlyFeeReport',['sectionId'=>$sectionId,'classId'=>$classId,'sessionYear'=>$sessionYear,'sessionYearId'=>$sessionYearId]);
                     }else{
                         return redirect()->back()->with('Session Expired!. You are not enroled in any class');
                     }
                 }

             }

         }


    public function monthlyFeeReportDetails($month,$sessionYearId,$sectionId)
    {

    $bId=Auth::guard('web')->user()->bId;

    //Section wise Monthly Report

    $sectionCalculation=DB::select("SELECT fee_collections.sectionId, sections.sectionName,  sections.shift, classes.className,
                                    COALESCE(sum(case when fees.type='gov' then fee_collections.totalAmount end), 0) as govtpayment,
                                    COALESCE(sum(case when fees.type='nonGov' then fee_collections.totalAmount end), 0) as Nongovtpayment,

                                    COALESCE(sum(fee_collections.totalAmount), 0) as total,
                                    COALESCE(sum(fee_collections.due), 0) as totaldue


                                    FROM fee_collections, fees, sections, classes
                                    WHERE fee_collections.feeId=fees.id
                                    AND fees.classid=classes.id
                                    AND fee_collections.sectionId=sections.id
                                    AND fee_collections.sessionYearId='$sessionYearId'
                                    AND fee_collections.bId='$bId'
                                    AND fee_collections.paidMonth='$month'
                                    AND fee_collections.sectionId='$sectionId'
                                    GROUP BY fee_collections.sectionId");

        $sectionTotalTableOutput="";
        $i=1;
        foreach ($sectionCalculation as $sectionTotal) {


            $sectionTotalTableOutput.='<tr>'.
            '<td>'.$i++.'</td>'.
            '<td>'.$sectionTotal->className.'</td>'.
            '<td>'.$sectionTotal->sectionName.'</td>'.
            '<td>'.$sectionTotal->shift.'</td>'.
                '<td>'.$sectionTotal->govtpayment.'</td>'.
                '<td>'.$sectionTotal->Nongovtpayment.'</td>'.
                '<td>'.$sectionTotal->total.'</td>'.
                '<td>'.$sectionTotal->totaldue.'</td>'.
              // '<td>'.$sectionTotal->totalduecollection.'</td>'.
                // '<td>'.$sectionTotal->t.'</td>'.
                '</tr>';
        }


        //Government Fee Type Report
        $governmentFeeTotal=DB::select("SELECT sectionName,sectionId,feeId, fees.classId, classes.className, sections.shift, fees.name,
                                        SUM(fee_collections.totalAmount) as total,
                                        COUNT( DISTINCT fee_collections.studentId) as totalStudent,
                                        sum(fee_collections.due) as totaldue
                                        FROM fee_collections, fees, sections, classes
                                        WHERE fee_collections.feeId=fees.id
                                        AND fees.classid=classes.id
                                        AND fee_collections.sectionId=sections.id
                                        AND fee_collections.sessionYearId='$sessionYearId'
                                        AND fee_collections.paidMonth='$month'
                                        AND fee_collections.bId='$bId'
                                        AND fee_collections.sectionId='$sectionId'
                                        AND fees.type='gov'
                                        GROUP BY feeId, fee_collections.sectionId
                                        ORDER BY fee_collections.sectionId");

                $governmentFeeTableOutput="";
                $i=1;

                    foreach ($governmentFeeTotal as $feeTotal) {

                        $governmentFeeTableOutput.='<tr>'.
                        '<td>'.$i++.'</td>'.
                        '<td>'.$feeTotal->className.'</td>'.
                        '<td>'.$feeTotal->sectionName.'</td>'.
                        '<td>'.$feeTotal->shift.'</td>'.
                        '<td>'.$feeTotal->name.'</td>'.
                        '<td>'.$feeTotal->total.'</td>'.
                        '<td>'.$feeTotal->totaldue.'</td>'.
                        '<td>'.$feeTotal->totalStudent.'</td>'.
                        '<td>'.'<button class="btn btn-primary details"  onClick="details('.$feeTotal->sectionId.','.$feeTotal->classId.','.$feeTotal->feeId.')" name="button" id="submit" ><i class="fa fa-plus-square" aria-hidden="true"></i>Details</button>'.'</td>'.
                        '</tr>';
                    }


        //Non-Government Fee Type Report
        $nonGovtFeeTotal=DB::select("SELECT sectionName,sectionId,feeId, fees.classId, classes.className, sections.shift, fees.name,
                                        SUM(fee_collections.totalAmount) as total,
                                        COUNT(DISTINCT fee_collections.studentId) as totalStudent,
                                        sum(fee_collections.due) as totaldue
                                        FROM fee_collections, fees, sections, classes
                                        WHERE fee_collections.feeId=fees.id
                                        AND fees.classid=classes.id
                                        AND fee_collections.sectionId=sections.id
                                        AND fee_collections.sessionYearId='$sessionYearId'
                                        AND fee_collections.paidMonth='$month'
                                        AND fee_collections.bId='$bId'
                                        AND fee_collections.sectionId='$sectionId'
                                        AND fees.type='nonGov'
                                        GROUP BY feeId, fee_collections.sectionId
                                        ORDER BY fee_collections.sectionId");

                    $nonGovtFeeTableOutput="";
                    $i=1;

                        foreach ($nonGovtFeeTotal as $nongovtfee) {

                        $nonGovtFeeTableOutput.='<tr>'.
                        '<td>'.$i++.'</td>'.
                        '<td>'.$nongovtfee->className.'</td>'.
                        '<td>'.$nongovtfee->sectionName.'</td>'.
                        '<td>'.$nongovtfee->shift.'</td>'.
                        '<td>'.$nongovtfee->name.'</td>'.
                        '<td>'.$nongovtfee->total.'</td>'.
                        '<td>'.$nongovtfee->totaldue.'</td>'.
                        '<td class="details">'.$nongovtfee->totalStudent.'</td>'.
                        '<td>'.'<button class="btn btn-primary details"  onClick="details('.$nongovtfee->sectionId.','.$nongovtfee->classId.','.$nongovtfee->feeId.')" name="button" id="submit" ><i class="fa fa-plus-square" aria-hidden="true"></i>Details</button>'.'</td>'.

                        '</tr>';
                        }

         //Due collection  Fee Type Report  //AND fees.type='nonGov'
         $dueFeeTotals=DB::select("SELECT sectionName, fees.classId, classes.className, sections.shift, fees.name, due_fee_histories.paidMonth,fee_collections.month,
                                        SUM(due_fee_histories.paidAmount) as total,
                                        COUNT(due_fee_histories.feeCollectionId) as totalStudent
                                        FROM fee_collections, fees, sections, classes,due_fee_histories
                                        WHERE fee_collections.feeId=fees.id
                                        AND due_fee_histories.feeCollectionId=fee_collections.id
                                        AND fees.classid=classes.id
                                        AND fee_collections.sectionId=sections.id
                                        AND fee_collections.sessionYearId='$sessionYearId'
                                        AND due_fee_histories.paidMonth='$month'
                                        AND fee_collections.bId='$bId'
                                        AND fee_collections.sectionId='$sectionId'
                                        GROUP BY feeId, fee_collections.sectionId
                                        ORDER BY fee_collections.sectionId");

                        $dueFeeTotalsdata="";
                        $i=1;

                        foreach ($dueFeeTotals as $dueFeeTotal) {

                        $dueFeeTotalsdata.='<tr>'.
                        '<td>'.$i++.'</td>'.
                        '<td>'.$dueFeeTotal->className.'</td>'.
                        '<td>'.$dueFeeTotal->sectionName.'</td>'.
                        '<td>'.$dueFeeTotal->shift.'</td>'.
                        '<td>'.$dueFeeTotal->name.'</td>'.
                        '<td>'.$dueFeeTotal->total.'</td>'.
                        '<td>'.$dueFeeTotal->totalStudent.'</td>'.
                        '<td>'.$dueFeeTotal->month.'</td>'.
                        '<td>'.$dueFeeTotal->paidMonth.'</td>'.

                        '</tr>';
                        }

        return Response()->json(["sectionTotalTableOutput"=>$sectionTotalTableOutput,"governmentFeeTableOutput"=>$governmentFeeTableOutput,"nonGovtFeeTableOutput"=>$nonGovtFeeTableOutput,"dueFeeTotalsdata"=>$dueFeeTotalsdata]);

    }

     //studentFeeDetails
     public function monthlyStudentFeeReport(){


        $userId= Auth::guard('web')->user()->id;
        //dd($userId);
        $bId= Auth::guard('web')->user()->bId;
        //dd($bId);
        $teachers= ClassTeacher::where('userId',$userId)->where('bId',$bId)->with('Section')->count();
        //dd($teachers);
        if($teachers<=0){

             return "You are not enroled in any class";

        }else{

            $teachers= ClassTeacher::where('userId',$userId)->where('bId',$bId)->with('Section')->get();
            foreach($teachers as $teacher){
                    if($teacher->Section->sessionYear->status == 1){
                        //dd($teacher->Section);
                        $classId = $teacher->classId;
                        //$shift = $teacher->shift;
                        $sessionYearId = $teacher->sessionYearId;
                        $sessionYear = SessionYear::where('id',$sessionYearId)->get();


                        $sectionId = $teacher->sectionId;


                    return view('backend.pages.classTeacher.myclassMonthlyStudentFeeDetails',['sectionId'=>$sectionId,'classId'=>$classId,'sessionYear'=>$sessionYear,'sessionYearId'=>$sessionYearId]);
                }else{
                    return redirect()->back()->with('Session Expired!. You are not enroled in any class');
                }
            }

        }
     }

     //student credential

     public function credentialIndex()
      {
       $userId= Auth::guard('web')->user()->id;
         //dd($userId);
         $bId= Auth::guard('web')->user()->bId;
         //dd($bId);
         $teachers= ClassTeacher::where('userId',$userId)->where('bId',$bId)->with('Section')->count();
         //dd($teachers);
         if($teachers<=0){

              return "You are not enroled in any class";

         }else{

             $teachers= ClassTeacher::where('userId',$userId)->where('bId',$bId)->with('Section')->get();
             foreach($teachers as $teacher){
                     if($teacher->Section->sessionYear->status == 1){
                         //dd($teacher->Section);
                         $classId = $teacher->classId;
                         $shift = $teacher->shift;
                         $sessionYearId = $teacher->sessionYearId;
                         $sessionYear = SessionYear::where('id',$sessionYearId)->pluck('sessionYear');

                         $className= classes::where('id',$classId)->pluck('className');
                         $sectionId = $teacher->sectionId;
                         $sectionName= Section::where('id',$sectionId)->pluck('sectionName');

                     return view('backend.pages.classTeacher.myStudentCredentialList',['sectionId'=>$sectionId,'sectionName'=>$sectionName,'classId'=>$classId,'className'=>$className,'sessionYear'=>$sessionYear,'sessionYearId'=>$sessionYearId,'shift'=>$shift]);
                 }else{
                     return redirect()->back()->with('Session Expired!. You are not enroled in any class');
                 }
             }

         }
      }

    public function credentiallist($classId,$sectionId,$sessionYearId)
    {
        $bId=Auth::guard('web')->user()->bId;
        // $student=Student::orderBy('id','DESC')->where('bId',Auth::guard('web')->user()->bId)->whereNull('deleted_at')->with('Section')->get();
        $student=DB::select("select students.id as stdId,students.studentId, students.firstName, students.lastName, students.mobile,students.readablePassword,
            students.roll,classes.className,sections.sectionName,sections.shift
                                 from students, sections, classes
                                 WHERE sections.classId=classes.id
                                 AND students.sectionId=sections.id
                                 And classes.id='$classId'
                                 And sections.id='$sectionId'
                                 AND sections.sessionYearId='$sessionYearId'
                                 AND students.bId='$bId'");
        
//return $student;
        $data_table_render = DataTables::of($student)

            ->addColumn('action',function ($student){
               //$edit_url = url('mystudent/show/studentProfile/'.$row['id']);
                return '<button id="modelid" onclick="myFunction('.$student->stdId.')" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button>'.
                '<a  onClick="deleteStudent('.$student->stdId.')" class="btn btn-danger btn-sm delete_class"><i class="fa fa-trash-o"></i></a>';
            })
            ->editColumn('firstName', function($student)
                          {
                             return $student->firstName. " ".$student->lastName;
                          })
            // ->editColumn('section.classes', function($student)
            //               {
            //                  return $student->Section->classes->className;
            //               })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        return $data_table_render;
    }


     //student credential

     public function scholarShipIndex()
      {
       $userId= Auth::guard('web')->user()->id;
         //dd($userId);
         $bId= Auth::guard('web')->user()->bId;
         //dd($bId);
         $teachers= ClassTeacher::where('userId',$userId)->where('bId',$bId)->with('Section')->count();
         //dd($teachers);
         if($teachers<=0){

              return "You are not enroled in any class";

         }else{

             $teachers= ClassTeacher::where('userId',$userId)->where('bId',$bId)->with('Section')->get();
             foreach($teachers as $teacher){
                     if($teacher->Section->sessionYear->status == 1){
                         //dd($teacher->Section);
                         $classId = $teacher->classId;
                         $shift = $teacher->shift;
                         $sessionYearId = $teacher->sessionYearId;
                         $sessionYear = SessionYear::where('id',$sessionYearId)->pluck('sessionYear');

                         $className= classes::where('id',$classId)->pluck('className');
                         $sectionId = $teacher->sectionId;
                         $sectionName= Section::where('id',$sectionId)->pluck('sectionName');

                     return view('backend.pages.classTeacher.scholarshipList',['sectionId'=>$sectionId,'sectionName'=>$sectionName,'classId'=>$classId,'className'=>$className,'sessionYear'=>$sessionYear,'sessionYearId'=>$sessionYearId,'shift'=>$shift]);
                 }else{
                     return redirect()->back()->with('Session Expired!. You are not enroled in any class');
                 }
             }

         }
      }
      //end 
    
    //find scholarship student list
    public function scholarshiplist($classId,$sectionId,$sessionYearId){
        $bId=Auth::guard('web')->user()->bId;
        $scholarshiplist=DB::select("SELECT  students.id as id,students.roll,students.firstName,students.lastName,students.fatherName,students.motherName,
                                    students.blood,students.birthDate,students.mobile,classes.className,sections.sectionName,sections.shift,scholarships.name,
                                    session_years.sessionYear
                                    FROM students,student_scholarships,classes,sections,scholarships,session_years
                                    where students.id=student_scholarships.studentId
                                    AND scholarships.id=student_scholarships.scholershipId
                                    AND sections.id=students.sectionId
                                    AND session_years.id=sections.sessionYearId
                                    AND classes.id=sections.classid
                                    And classes.id='$classId'
                                    And sections.id='$sectionId'
                                    AND sections.sessionYearId='$sessionYearId'
                                    AND students.bId='$bId'
                                    AND students.deleted_at IS NULL

                                    ");

       // $scholarshiplist=studentScholarship::orderBy('id','DESC')->where('bId',Auth::guard('web')->user()->bId)->with('Student')->with('Fee')->get();
             $data_table_render = DataTables::of($scholarshiplist)

             ->addColumn('action',function ($student){
                $edit_url = url('mystudent/show/studentProfile/'.$student->id);
                 return '<a href="'.$edit_url.'" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>'.
                 '<a  onClick="deleteStudent('.$student->id.')" class="btn btn-danger btn-sm delete_class"><i class="fa fa-trash-o"></i></a>';
             })
             ->editColumn('firstName', function($scholarshiplist)
                          {
                             return $scholarshiplist->firstName. " ".$scholarshiplist->lastName;
                          })
            //  ->editColumn('sections.classes', function($scholarshiplist)
            //  {
            //     return $scholarshiplist->Section->classes->className;
            //  })
             ->rawColumns(['action'])
             ->addIndexColumn()
             ->make(true);
             return $data_table_render;

    }



}
