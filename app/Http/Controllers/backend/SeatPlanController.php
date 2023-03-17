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

class SeatPlanController extends Controller
{
    public function seatPlan(){
        $class=classes::where('bid', Auth::guard('web')->user()->bId)->get();
        $section=Section::where('bid', Auth::guard('web')->user()->bId)->get();
        $sessionYear= SessionYear::where('bId', Auth::guard('web')->user()->bId)->get();
        $exam= exam::where('bId', Auth::guard('web')->user()->bId)->get();

        return view('backend.pages.seatPlan.seatPlanGenerate')->with('class', $class)->with('section', $section)->with('sessionYear',$sessionYear)->with('exam',$exam);
    }

    public function seatPlanPrint($classId, $sectionId, $examName,$room)
    {
        $userId= Auth::guard('web')->user()->id;
        //dd($userId);
        $bId= Auth::guard('web')->user()->bId;
            //$class=DB::select("select * from students, sections, files, classes WHERE sections.classId=classes.id AND students.sectionId=sections.id And classes.id='$classId' And sections.id='$sectionId' and files.studentId=students.Id");
            // dd($class);
            if ((Auth::guard('web')->user()->hasAllPermissions('Seat Plan'))) {
                $class=Student::where('sectionId', $sectionId)->get();
            // dd($class);
                
                return view('backend.pages.seatPlan.printSeatPlan',[
                    'class'=>$class, 
                    'examName'=>$examName,
                    'room'=>$room
                    ]);
               
            } 
            elseif((Auth::guard('web')->user()->hasAllPermissions('Class Teacher'))) {
                $teachers= ClassTeacher::where('userId',$userId)->where('bId',$bId)->with('Section')->get();
                foreach($teachers as $teacher){
                        if($teacher->Section->sessionYear->status == 1){
                            //dd($teacher->Section);
                            $classId = $teacher->classId;
                            $ClSectionId = $teacher->sectionId;
                $class=Student::where('sectionId',$ClSectionId)->with('Section', 'files')->get();
                
                return view('backend.pages.seatPlan.printSeatPlan',[
                    'class'=>$class, 
                    'examName'=>$examName,
                    'room'=>$room
                    ]);
                        }
                    }
               
            }


            // $class=Student::where('sectionId', $sectionId)->get();
            // // dd($class);
                
            // return view('backend.pages.seatPlan.printSeatPlan',[
            //     'class'=>$class, 
            //     'examName'=>$examName,
            //     'room'=>$room
            //     ]);
    }
}
