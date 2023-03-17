<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\model\scholarship;
use App\model\Fee;
use App\model\classes;
use App\model\Section;
use App\model\SessionYear;
use App\model\Student;
use App\model\studentScholarship;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
Use Illuminate\Support\Facades\DB;
Use Illuminate\Support\Facades\Auth;


class ScholarshipController extends Controller
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
      return view('backend.pages.scholarshipManagement.manageScholarship');
    }
    public function getAllScholarshipById($Id)
    {
        $Scholarship=Fee::where(Auth::guard('web')->user()->bId)->where('classId', $Id)->get();
        return Response()->json($Scholarship);
    }

    //add student scholarship
    public function studentScholarshiplist()
    {
        $class= classes::where('bId', Auth::guard('web')->user()->bId)->get();
        $sessionYear= SessionYear::where('bId', Auth::guard('web')->user()->bId)->get();
        $scholarships= scholarship::orderBy('id','DESC')->where('bId',Auth::guard('web')->user()->bId)->get();
      return view('backend.pages.scholarshipManagement.StudentScholarshiplist', compact("class","sessionYear","scholarships"));
    }

    //datatable list
        //find scholarship student list
    public function scholarshiplist(){
        $bId=Auth::guard('web')->user()->bId;
        $scholarshiplist=DB::select("SELECT  student_scholarships.id as id,students.id as stdid,students.roll,students.firstName,students.lastName,students.fatherName,students.motherName,
                                    students.blood,students.birthDate,students.mobile,classes.className,sections.sectionName,sections.shift,scholarships.name,
                                    session_years.sessionYear
                                    FROM students,student_scholarships,classes,sections,scholarships,session_years
                                    where students.id=student_scholarships.studentId
                                    AND scholarships.id=student_scholarships.scholershipId
                                    AND sections.id=students.sectionId
                                    AND session_years.id=sections.sessionYearId
                                    AND classes.id=sections.classid
                                    AND students.bId='$bId'
                                    AND students.deleted_at IS NULL

                                    ");

       // $scholarshiplist=studentScholarship::orderBy('id','DESC')->where('bId',Auth::guard('web')->user()->bId)->with('Student')->with('Fee')->get();
             $data_table_render = DataTables::of($scholarshiplist)

             // ->addColumn('action',function ($student){
             //    $edit_url = url('mystudent/show/studentProfile/'.$student->id);
             //     return '<a href="'.$edit_url.'" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>'.
             //     '<a  onClick="deleteStudent('.$student->id.')" class="btn btn-danger btn-sm delete_class"><i class="fa fa-trash-o"></i></a>';
             // })
             ->addColumn('action',function ($scholarshiplist){
                return '<button class="btn btn-info btn-sm" onClick="editScholarship('.$scholarshiplist->id.')"><i class="fa fa-edit"></i></button>'.'<button class="btn btn-danger btn-sm delete_scholarship" onClick="deletestudentScholarshiplist('.$scholarshiplist->id.')"><i class="fa fa-trash-o"></i></button>';
            })
             //for delete
             //.
            // '<button  onClick="deleteScholarship('.$scholarshiplist->id.')" class="btn btn-danger btn-sm delete_section"><i class="fa fa-trash-o"></i></button>'

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

    //student list to add scholarship
     public function Studentlist(Request $request)
    {
        $sectionId= $request->sectionId;
            $students = Student::where('sectionId',$sectionId)->where('schoolarshipId',"0")
            ->where('bId', Auth::guard('web')->user()->bId)
            ->get();
            return response()->json($students);
    }
    //fee list
     public function feelist(Request $request)
    {
        $classId= $request->classId;
        $sessionYearId= $request->sessionYearId;
            $fees = Fee::where('classId',$classId)->where('sessionYearId',$sessionYearId)
            ->where('bId', Auth::guard('web')->user()->bId)
            ->get();
            return response()->json($fees);
    }

     //find student information for edit   
     public function editstudentlist($id)
    {
        //  $bId=Auth::guard('web')->user()->bId;
        // $student = DB::select("SELECT  students.id as id,students.roll,students.firstName,students.lastName,
        //                                classes.id as classId,classes.className,
        //                                sections.id as sectionId,sections.sectionName,sections.shift,
        //                                scholarships.id as scholarshipId,scholarships.name,
        //                                session_years.id as sessionYearId,session_years.sessionYear,
        //                                fees.id as feeId,fees.name as feename
        //                             FROM students,student_scholarships,classes,sections,scholarships,session_years,fees
        //                             where students.id=student_scholarships.studentId
        //                             AND scholarships.id=student_scholarships.scholershipId
        //                             AND sections.id=students.sectionId
        //                             AND session_years.id=sections.sessionYearId
        //                             AND classes.id=sections.classid
        //                             AND fees.classId=classes.id
        //                             AND student_scholarships.feeId=fees.id
        //                             AND students.bId='$bId'
        //                             AND students.id='$id'
        //                             AND students.deleted_at IS NULL

        //                             ");
        $student = Student::with('Section')->with('studentScholarship')->find($id);                             
//        return view('backend.AddClass.addStudentClass')
//            ->with('studentClss',$studentclg);
        return Response()->json($student);
    }

    public function studentlistStore(Request $request)
    {

        //return $request;
        $validator= Validator::make($request->all(), scholarship::$studentScholarshiprules);
        if ($validator->fails()) {
            return response()->json(["errors"=>$validator->errors(), 400]);
        }else{

            $student = student::where('id',$request->studentId)->where('sectionId',$request->sectionId)->where('bId', Auth::guard('web')->user()->bId)->firstOrFail();
           
            if($student!=null){
                $student->schoolarshipId =$request->scholarshipId;
                if($request->scholarshipId>0){
                $scholarship = new studentScholarship;
                $scholarship->studentId=$request->studentId;
                $scholarship->scholershipId =$request->scholarshipId;
                $scholarship->feeId =$request->feeId;
                $scholarship->discount =$request->discount;
                $scholarship->sessionYear =$request->sessionYearId;
                $scholarship->bId=Auth::guard('web')->user()->bId;
                $scholarship->save();
                }
                $student->save();
                return Response()->json(["success"=>'Updated', "data"=>$student,201]);
                }else{
                return "not found or Issue in Database ";
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
    public function store(Request $request)
     {
        $validator= Validator::make($request->all(), Scholarship::$rules);
        if ($validator->fails()) {
            return response()->json(["errors"=>$validator->errors(), 400]);
        }else{
        $scholarship = new Scholarship();
        $scholarship->name = $request->name;
        $scholarship->discount = $request->discount;
        $scholarship->bId = Auth::guard('web')->user()->bId;
        $scholarship->save();

        //message
        return Response()->json(["success"=>'saved',"data"=>$scholarship]);
        // Session::flash('success','Succesfully Add Class Data Saved');
        // return redirect()->back();
       }
     }

    /**
     * Display the specified resource.
     *
     * @param  \App\model\scholarship  $scholarship
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $scholarship=scholarship::orderBy('id','DESC')->where('bId',Auth::guard('web')->user()->bId)->get();

        $data_table_render = DataTables::of($scholarship)

            ->addColumn('action',function ($row){

                return '<button class="btn btn-info btn-sm" onClick="editScholarship('.$row['id'].')"><i class="fa fa-edit"></i></button>'.
                    '<button  onClick="deleteScholarship('.$row['id'].')" class="btn btn-danger btn-sm delete_class"><i class="fa fa-trash-o"></i></button>';
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        return $data_table_render;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\model\scholarship  $scholarship
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $scholarshipS = scholarship::find($id);
        return Response()->json($scholarshipS);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\model\scholarship  $scholarship
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator= Validator::make($request->all(), scholarship::$rules);
        if ($validator->fails()) {
            return response()->json(["errors"=>$validator->errors(), 400]);
        }else{

       $uScholarship = scholarship::find($id);
       $uScholarship->name = $request->name;
       $uScholarship->discount = $request->discount;
       $uScholarship->save();

        return response()->json(["success"=>'Stored', "data"=>$uScholarship ,201]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\model\scholarship  $scholarship
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Scholarship = scholarship::find($id);

        if($Scholarship){
            $Scholarship->delete();
            return response()->json('successful',201);
        }
        return response()->json('error',422);
    }

     public function scholarshipdestroy($id)
    {
        $studentScholarship = studentScholarship::find($id);
        //return $studentScholarship;
        $studentId = $studentScholarship->studentId;

        $student =student::findOrFail($studentId);
        $student->schoolarshipId = 0;
        $student->save();
        if($student){
            $studentScholarship->delete();
            return response()->json(["success"=>'Student is Deleted from scholarship list.',201]);
        }
        return response()->json(["error"=>'error',422]);
    }
}
