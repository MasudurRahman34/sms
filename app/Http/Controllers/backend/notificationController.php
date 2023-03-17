<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notification\emailService;
use App\Notification\smsService;
use App\Notification\Contact\smsContact;
use App\model\classes;
use App\model\Student;
use App\model\Section;
use App\model\SessionYear;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class notificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function __construct()
    {
        //$this->emailService= new emailService();
        $this->smsService= new smsService();
        $this->smsContact= new smsContact();
        //$this->middleware('guest');
    }
    public function index()
    {
        return view('backend.pages.notification.notification');
    }

    public function notificationBoard()
    {
        return view('backend.pages.notification.notificationBoard');
    }

    public function notificationEmailSms()
    {
        return view('backend.pages.notification.sendEmailSms');
    }

    public function emailSmsLog(){
        return view('backend.pages.notification.emailSmsLog');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $msg=$request->msg;
        $sendBy=$request->sendBy;
        $contactTypes=$request->contactType;
        foreach ($sendBy as $sendBy){
            if ($sendBy=='sms') {
                $smsContact=$this->smsContact;
                $smsContact=$smsContact->getContact($contactTypes);
                $notifyBy= $this->smsService;
                $notifyBy->notification($smsContact, $msg);
            } elseif($sendBy=='email') {
                # code...
            }else{

            }

        }
        return redirect()->back();
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
        //
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
