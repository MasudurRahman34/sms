<?php

namespace App\Http\Controllers\backend;

use App\model\classes;
use App\model\Student;
use App\model\Section;
use App\model\exam;
use App\model\SessionYear;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\ClassTeacher;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Session\Session;

class AdmitCardController extends Controller
{
    public function AdmitCardController(){
        $class=classes::where('bid', Auth::guard('web')->user()->bId)->get();
        $section=Section::where('bid', Auth::guard('web')->user()->bId)->get();
        $sessionYear= SessionYear::where('bId', Auth::guard('web')->user()->bId)->get();
        $exam= exam::where('bId', Auth::guard('web')->user()->bId)->get();

        return view('backend.pages.studentAdmitCard.admitCardGenerate')->with('class', $class)->with('section', $section)->with('sessionYear',$sessionYear)->with('exam', $exam);
    }

    public function sectionwiselist($classId, $sectionId, $examName)
    {
        $userId= Auth::guard('web')->user()->id;
        //dd($userId);
        $bId= Auth::guard('web')->user()->bId;
            //$class=DB::select("select * from students, sections, files, classes WHERE sections.classId=classes.id AND students.sectionId=sections.id And classes.id='$classId' And sections.id='$sectionId' and files.studentId=students.Id");
            // dd($class);
            if ((Auth::guard('web')->user()->hasAllPermissions('Admit Card'))) {
                $class=Student::where('sectionId',$sectionId)->with('Section', 'files')->get();
                
                return view('backend.pages.studentAdmitCard.admitCard',['class'=>$class,'examName'=>$examName]);
               
            } 
            elseif((Auth::guard('web')->user()->hasAllPermissions('Class Teacher'))) {
                $teachers= ClassTeacher::where('userId',$userId)->where('bId',$bId)->with('Section')->get();
                foreach($teachers as $teacher){
                        if($teacher->Section->sessionYear->status == 1){
                            //dd($teacher->Section);
                            $classId = $teacher->classId;
                            $ClSectionId = $teacher->sectionId;
                $class=Student::where('sectionId',$ClSectionId)->with('Section', 'files')->get();
                
            return view('backend.pages.studentAdmitCard.admitCard',['class'=>$class,'examName'=>$examName]);
                        }
                    }
               
            }
            

            
    }

    //individual admit card
    public function individualAdmitCardController(){
        $class=classes::where('bid', Auth::guard('web')->user()->bId)->get();
        $section=Section::where('bid', Auth::guard('web')->user()->bId)->get();
        $sessionYear= SessionYear::where('bId', Auth::guard('web')->user()->bId)->get();
        $exam= exam::where('bId', Auth::guard('web')->user()->bId)->get();

        return view('backend.pages.studentAdmitCard.individualAdmitCardGenerate')->with('class', $class)->with('section', $section)->with('sessionYear',$sessionYear)->with('exam', $exam);

    }

    public function individualsectionwiselist($classId, $sectionId)
    {
        
        
        //$bId=Auth::guard('web')->user()->bId;
        //$class=DB::select("select * from students, sections, classes WHERE sections.classId=classes.id AND students.sectionId=sections.id And classes.id='$classId' And sections.id='$sectionId'");
        $student=Student::where('sectionId', $sectionId)->get();

            return response()->json($student);
    }

    public function AdmitCardPrint($id,$examName)
    {
        
        $studentinfo=Student::where('id', $id)->with('Section')->firstOrfail();
        //return $studentinfo;
        // $students=Student::with('classes','Section')
        // ->where('bId', Auth::guard('web')->user()->bId)
        // ;
        // dd($students);
        // $student=Student::where('bid', Auth::guard('web')->user()->bId)->get();
        // $classs=classes::where('bid', Auth::guard('web')->user()->bId)->get();
        // $section=Section::where('bid', Auth::guard('web')->user()->bId)->get();

       // $students=DB::select("select * from students, sections, classes WHERE sections.classId=classes.id AND students.sectionId=sections.id And classes.id='$id' And sections.id='$id'");
        //dd($students);
        return view('backend.pages.studentAdmitCard.printIndividualAdmitCard',['students'=> $studentinfo, 'examName'=>$examName]);
    }
}
