<?php
namespace App\Notification;
use Illuminate\Support\Facades\Mail;
use App\Notification\Mail\email;
 class emailService implements NotificationProcess
 {
    public function notification($contact, $msg){
         Mail::to($contact)->send(new email($msg));
    }
 }

