<?php

namespace App\Http\Controllers\backend\report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function classbasedReport(){
        return view('backend.pages.report.classBasedIncomeReport');
    }

    public function dateWiseIncomeExpanseReport(){
        return view('backend.pages.report.dateWiseIncomeExpanseReport');
    }

    public function gradeBasedResultReport(){
        return view('backend.pages.report.gradeBasedResultReport');
    }

    public function sectionBasedAttendenceRe(){
        return view('backend.pages.report.sectionBasedAttendenceReport');
    }

    public function staffAttendenceRe(){
        return view('backend.pages.report.staffAttendenceReport');
    }
}
