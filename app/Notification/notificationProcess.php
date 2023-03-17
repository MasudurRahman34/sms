<?php
namespace App\Notification;
interface NotificationProcess{

    public function notification($contact, $msg);
}
