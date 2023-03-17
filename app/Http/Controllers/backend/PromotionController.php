<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//add;
use App\model\classes;
use App\model\exam;
use App\model\Mark;
use App\model\studentHistory;
use App\model\Student;
use App\model\Subject;
use App\model\Section;
use App\model\SessionYear;
use App\model\studentFee;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Auth;

class PromotionController extends Controller
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
        $class=classes::where('bid', Auth::guard('web')->user()->bId)->get();
        $section=Section::where('bid', Auth::guard('web')->user()->bId)->get();
        $sessionYear= SessionYear::where('bId', Auth::guard('web')->user()->bId)->get();
       
        return view('backend.pages.promotion.promotion')->with('class', $class)->with('section', $section)->with('sessionYear',$sessionYear);
    }




    public function studentlist($classId,$sectionId,$sessionYearId)
    {
        $bId=Auth::guard('web')->user()->bId;
        // $student=Student::orderBy('id','DESC')->where('bId',Auth::guard('web')->user()->bId)->whereNull('deleted_at')->with('Section')->get();
        $student=DB::select("select students.id,students.studentId, students.firstName, students.lastName, students.mobile,students.readablePassword,
            students.roll,classes.className,sections.sectionName,sections.shift
                                 from students, sections, classes
                                 WHERE sections.classId=classes.id
                                 AND students.sectionId=sections.id
                                 And classes.id='$classId'
                                 And sections.id='$sectionId'
                                 AND sections.sessionYearId='$sessionYearId'
                                 AND students.bId='$bId'");
        
        // //return $student;
        // $data_table_render = DataTables::of($student)

        //     ->addColumn('action',function ($student){
        //        //$edit_url = url('mystudent/show/studentProfile/'.$row['id']);
        //         return '<button id="modelid" onclick="myFunction('.$student->stdId.')" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button>';
        //     })
        //     ->editColumn('firstName', function($student)
        //                   {
        //                      return $student->firstName. " ".$student->lastName;
        //                   })
        //     // ->editColumn('section.classes', function($student)
        //     //               {
        //     //                  return $student->Section->classes->className;
        //     //               })
        //     ->rawColumns(['action'])
        //     ->addIndexColumn()
        //     ->make(true);
        // return $data_table_render;
         return response()->json($student);
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

        $request->promotesectionId;
        
        foreach ($request->student as $id => $promotionRoll) {

            if($promotionRoll!=0){
            $studentinfo=Student::findOrFail($id);
            $studentHistory= new studentHistory;
            $studentHistory->sId=$studentinfo->id;
            $studentHistory->roll=$studentinfo->roll;
            $studentHistory->group=$studentinfo->group;
            $studentHistory->schoolarshipStatus=$studentinfo->schoolarshipId;
            $studentHistory->sectionId=$studentinfo->sectionId;
            $studentHistory->type=$studentinfo->type;
            $studentHistory->bId=$studentinfo->bId;


            $studentinfo->roll=$promotionRoll;
            $studentinfo->group=$request->promoteGroup;
            $studentinfo->sectionId=$request->promotesectionId;
            if($studentinfo->save()){
                $studentHistory->save();
                
                };//end if
            }//end if
        }//end foreacch
        Session::flash('success','Successfully Promoted');
        return redirect()->back();  
        
// =======
//         //return $request; 
//         //$stdId= $request->studentId;
//         $stdroll = $request->studentroll;


//         // foreach ($stdId as $id => $value) {
            
//              foreach ($stdroll as $key => $value) {
                      
//                 $student = Student::findOrFail($key);    
//                 $student->roll =$value;
//                 $student->sectionId =$request->promotesectionId;
//                 $student->update();
//             }  
//         // }
//         return redirect()->back()->with('success','student information updated');
        

// >>>>>>> Stashed changes
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
    public function edit($id)
    {
        //
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
}
