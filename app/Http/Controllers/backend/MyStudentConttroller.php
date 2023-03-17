<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\classes;
use App\model\Student;
use App\model\Section;
use App\model\SessionYear;
use App\model\studentScholarship;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\model\File;

class MyStudentConttroller extends Controller
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
       // $sessionYear= SessionYear::where('bId', Auth::guard('web')->user()->bId)->get();
        return view('backend.pages.mystudent.myStudentList');
    }
    
    public function allstudent()
    {
       
        return view('backend.pages.classTeacher.myStudentList');

    }
    public function allstudentlist()
    {

        $student=Student::orderBy('id','DESC')->where('bId',Auth::guard('web')->user()->bId)->whereNull('deleted_at')->with('Section')->get();
        //$student=DB::select("select * from students, sections WHERE students.sectionId=sections.id And sections.sessionYearId='$sessionYearId'");
        // foreach ($student as $value) {
        //     dd($value->Section->classes);
        // }
        // dd($student->Section->classes);
        //AND students.deleted_at IS NULL

        $data_table_render = DataTables::of($student)

            ->addColumn('action',function ($row){
               $edit_url = url('mystudent/show/studentProfile/'.$row['id']);
                return '<a href="'.$edit_url.'" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>'.
                '<a  onClick="deleteStudent('.$row['id'].')" class="btn btn-danger btn-sm delete_class"><i class="fa fa-trash-o"></i></a>';
            })
            ->editColumn('firstName', function($student)
                          {
                             return $student->firstName. " ".$student->lastName;
                          })
            ->editColumn('section.classes', function($student)
                          {
                             return $student->Section->classes->className;
                          })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        return $data_table_render;
    }


    //scholarship page
    public function scholarship(){

        return view('backend.pages.mystudent.scholarshipList');
    }

    //find scholarship student list
    public function scholarshiplist(){
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


    //class Wish student List
    public function classwise()
    {
        $class=classes::where('bid', Auth::guard('web')->user()->bId)->get();
        $sessionYear= SessionYear::where('bId', Auth::guard('web')->user()->bId)->get();

            return view('backend.pages.mystudent.classwiseStudent')->with('class', $class)->with('sessionYear',$sessionYear);

    }

    public function test(){
        return "working";
    }

    public function classwiseList($classId, $sessionYearId)

    {
        $bId=Auth::guard('web')->user()->bId;
            $class=DB::select("select students.id as stdId, students.firstName, students.lastName, students.fatherName,students.motherName,students.roll, students.blood, students.birthDate,students.mobile
                                from students, sections, classes
                                WHERE sections.classId=classes.id
                                AND students.sectionId=sections.id
                                And classes.id='$classId'
                                AND sections.sessionYearId='$sessionYearId'
                                AND students.bId='$bId'
                                AND students.deleted_at IS NULL
                                ");

                $data_table_render = DataTables::of($class)

                        ->editColumn('firstName', function($student)
                          {
                             return $student->firstName. " ".$student->lastName;
                          })
                        //   ->editColumn('session_years', function($student)
                        //   {
                        //      return $student->Section->SessionYear->sectionName;
                        //   })
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

    //class & section Wish student list
    public function Sectionwise()
    {
        $class=classes::where('bid', Auth::guard('web')->user()->bId)->get();
        $section=Section::where('bid', Auth::guard('web')->user()->bId)->get();
        $sessionYear= SessionYear::where('bId', Auth::guard('web')->user()->bId)->get();

            return view('backend.pages.mystudent.sectionwiseStudent')->with('class', $class)->with('section', $section)->with('sessionYear',$sessionYear);

    }

    public function sectionwiselist($classId, $sectionId, $sessionYearId)
    {
        $bId=Auth::guard('web')->user()->bId;
            $class=DB::select("select students.id as stdId, students.firstName, students.lastName, students.fatherName,students.motherName,students.roll, students.blood, students.birthDate,students.mobile
                                from students, sections, classes
                                WHERE sections.classId=classes.id
                                AND students.sectionId=sections.id
                                And classes.id='$classId'
                                And sections.id='$sectionId'
                                AND sections.sessionYearId='$sessionYearId'
                                AND students.bId='$bId'
                                AND students.deleted_at IS NULL ");

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



    public function previouse()
    {
        return view('backend.pages.mystudent.previouse');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $students=Student::with('schoolBranch','Section')
        ->where('bId', Auth::guard('web')->user()->bId)
        ->findOrFail($id);
        return view('backend.pages.mystudent.myStudentProfile',['students' => $students]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $students=Student::with('schoolBranch','Section')
        ->where('bId', Auth::guard('web')->user()->bId)
        ->findOrFail($id);
        return view('backend.pages.mystudent.updateProfile',['students' => $students]);
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
        // $this->validate($request,[
        //     'firstName'=>'string',
        //     'fatherName'=>'string',
        //     'motherName'=>'string',
        //     'gender'=>'',
        //     'birthDate'=>'',
        //     'religion'=>'',
        //     'address'=>'string',
        //     'mobile'=>'',
        //     'blood'=>'',
        //     'fatherOccupation'=>'required',
        //     'MotherOccupation'=>'',
        //     'fatherIncome'=>'string',
        //     'motherIncome'=>'',
        //     'address'=>'string',
        //     'mobile'=>'',
        // ]);
        // 2. data update
        //dd($request);
        $std = Student::find($id);
        $std->firstName = $request->firstName;
        $std->fatherName = $request->fatherName;
        $std->motherName = $request->motherName;
        $std->gender = $request->gender;
        $std->birthDate = $request->birthDate;
        $std->religion = $request->religion;
        $std->email = $request->email;
        $std->address = $request->address;
        $std->mobile = $request->mobile;
        $std->blood = $request->blood;
        $std->fatherOccupation = $request->fatherOccupation;
        $std->MotherOccupation = $request->MotherOccupation;
        $std->fatherIncome = $request->fatherIncome;
        $std->motherIncome = $request->motherIncome;
        $std->address = $request->address;
        $std->mobile = $request->mobile;
        // file upload
        if ($request->hasFile('image')){
            $image = $request->file('image');
            $filename = time().".".$image->getClientOriginalExtension();
            $path = base_path('image/students',$filename);
            $image->move($path,$filename);
            $previous_profile=File::where('type', 'profile')->where("studentId", $std->id)->first();
            if ($previous_profile){
                unlink(base_path("image/students/".$previous_profile->image));
                $previous_profile->delete();
            }
            $file = new File;
            $file->studentId=$std->id;
            $file->image=$filename;
            $file->type='profile';
            $file->Save();            
        }
        $std->save();
       // Session::flash('success','Successfully Student Profile Updated');
        //return redirect()->back();
        return view('backend.pages.mystudent.myStudentProfile',['students' => $std]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::find($id);
                if($student){
                    $student->delete();
                    return response()->json(["success"=>'Data Deleted',201]);
                }
            return response()->json(["error"=>'error',422]);
    }

    //showProfile method
    public function showProfile($id){




        //return view('backend.pagesmystudent.myStudentProfile');
    }
    public function subjectList($id){
      //$id=Auth::guard('student')->user()->id;
        $subjectlists=DB::select("select  subjects.*  from classes, sections, students, subjects
        where students.sectionId=sections.id and sections.classId=classes.id and classes.id=subjects.classId and subjects.group in (students.group, 'General') and subjects.optionalstatus=false and students.id='$id'");
        // return $subjectlist;
        // $opsubjectlist=DB::select("select  subjects.*  from classes, sections, students, subjects
        // where students.sectionId=sections.id and sections.classId=classes.id and classes.id=subjects.classId and subjects.group in (students.group, 'General') and subjects.optionalstatus=1 and students.id='$id'");
        $Student=student::find($id);

        return view('backend.pages.mystudent.subjectList',compact('subjectlists', 'Student'));
    }

     public function credentialIndex()
      {
       // $sessionYear= SessionYear::where('bId', Auth::guard('web')->user()->bId)->get();
        return view('backend.pages.mystudent.myStudentCredentialList'); 
      }

    public function credentiallist()
    {

        $student=Student::orderBy('id','DESC')->where('bId',Auth::guard('web')->user()->bId)->whereNull('deleted_at')->with('Section')->get();
        //$student=DB::select("select * from students, sections WHERE students.sectionId=sections.id And sections.sessionYearId='$sessionYearId'");
        // foreach ($student as $value) {
        //     dd($value->Section->classes);
        // }
        // dd($student->Section->classes);
        //AND students.deleted_at IS NULL

        $data_table_render = DataTables::of($student)

            ->addColumn('action',function ($row){
               //$edit_url = url('mystudent/show/studentProfile/'.$row['id']);
                return '<button id="modelid" onclick="myFunction('.$row['id'].')" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button>'.
                '<a  onClick="deleteStudent('.$row['id'].')" class="btn btn-danger btn-sm delete_class"><i class="fa fa-trash-o"></i></a>';
            })
            ->editColumn('firstName', function($student)
                          {
                             return $student->firstName. " ".$student->lastName;
                          })
            ->editColumn('section.classes', function($student)
                          {
                             return $student->Section->classes->className;
                          })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        return $data_table_render;
    }

    //change password
    public function changePassword(Request $request){
        $this->validate($request,[
            'old_password'=>'required',
            'password'=>'required||min:6|confirmed',
        ]);
      
       
     //return $request->stdID;
        // return $id;
       $students=Student::find($request->stdID);
    $hashedPassword=$students->password;

        if(Hash::check($request->old_password,$hashedPassword)){
                if(! Hash::check($request['password'],$hashedPassword)){
                $students-> readablePassword = $request['password'];
                $students->password = Hash::make($request->password);
                $students->save();
                Session::flash('success','You Have Successfully Changed The Password');
                return redirect()->back(); 
               }else{
                Session::flash('error','New Password Cannot Be The Same As Old Pass');
                return redirect()->back();
               }  
        }else{
            Session::flash('error','Old Password Does Not Matched');
            return redirect()->back();      
        }   
    }


}
