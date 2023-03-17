<?php

namespace App\Http\Controllers\backend\student;
use App\Http\Controllers\Controller;
use App\model\Student;
use App\User;
use App\model\Mark;
use App\model\File;
use App\model\exam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
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

        return view('backend.student.pages.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


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
     * @param  \App\model\Student  $student
     * @return \Illuminate\Http\Response
     */

     //student profile
    public function show()
    {
        $students=Student::with('schoolBranch','Section')
        ->where('bId', Auth::guard('student')->user()->bId)
        ->findOrFail(Auth::guard('student')->user()->id);

        // $examWiseMark=Mark:: where('studentId', Auth::guard('student')->user()->id)
        // ->where('sessionYearId', Auth::guard('student')->user()->id)
        // ->groupBy('examType')
        // ->get();
       
        
        return view('backend.student.pages.profile.profile',['students' => $students]);
    }

    //total student in a class
   public function totalStudent(){
    $classId=Auth::guard('student')->user()->Section->classes->id;
    $totalStudent=DB::select("select * from students, sections, classes WHERE sections.classId=classes.id AND students.sectionId=sections.id And classes.id='$classId'");
    $totalStudent =count($totalStudent);
    return Response()->json(["success"=>'Counted', "data"=>$totalStudent,201]);
   }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\model\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {

        $students=Student::with('schoolBranch','Section')
        ->where('bId', Auth::guard('student')->user()->bId)
        ->findOrFail(Auth::guard('student')->user()->id);
        return view('backend.student.pages.profile.updateProfile',['students' => $students]);
        //return view('backend.student.pages.profile.updateProfile');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\model\Student  $student
     * @return \Illuminate\Http\Response
     */


    public function update(Request $request)
    {
        // $this->validate($request,[
        //     'firstName'=>'string',
        //     'fatherName'=>'string',
        //     'motherName'=>'string',
        //     'gender'=>'',
        //     'birthDate'=>'',
        //     'religion'=>'',
        //     'email'=>'required|email|unique:students,email,'.Auth::guard('student')->user()->id,
        //     'address'=>'string',
        //     'mobile'=>'',
        //     'blood'=>'',
        //     'fatherOccupation'=>'',
        //     'MotherOccupation'=>'',
        //     'fatherIncome'=>'string',
        //     'motherIncome'=>'',
        //     'address'=>'string',
        //     'mobile'=>'',
        // $this->validate($request, [
        //     'image' => 'required|image|mimes:jpeg,png|max:180',
        // ]);

        $std = Student::find(Auth::guard('student')->user()->id);
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
        Session::flash('success','Successfully Student Profile Updated');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\model\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
    }

    //student School corner method
    public function schoolCorner(){
        // $students = DB::table('students')->count();
        // return $students;
        return view('backend.student.pages.schoolCorner.index');
    }
    //event
    public function eventDetails(){
        return view('backend.student.pages.schoolCorner.eventDetails');
    }
    //School gallery
    public function gellary(){
        return view('backend.student.pages.schoolCorner.gallery');
    }
    //School about
    //School gallery
    public function about(){
        return view('backend.student.pages.schoolCorner.about');
    }


    public function changePassword(Request $request){
        $this->validate($request,[
            'old_password'=>'required',
            'password'=>'required||min:6|confirmed',
        ]);
        $hashedPassword=Auth::guard('student')->user()->password;
        if(Hash::check($request->old_password,$hashedPassword)){
                if(! Hash::check($request['password'],$hashedPassword)){
                $students = Student::find(Auth::guard('student')->user()->id);
                $students-> readablePassword = $request['password'];
                $students->password = Hash::make($request->password);
                $students->save();
                Session::flash('success','You Have Successfully Changed The Password');
                Auth::logout();
                return redirect()->route('student.login'); 
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
