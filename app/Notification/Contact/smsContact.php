<?php
namespace App\Notification\Contact;
use App\model\classes;
use App\model\Student;
use App\model\Section;
use App\model\SessionYear;
use App\User;
use Illuminate\Support\Facades\DB;

class smsContact  implements contactProcess
 {
   public function getContact(array $contacts)
   {


    foreach($contacts as $key => $value ){

        if ($value=='student') {
            $contact[]=Student::where('sectionId', 1)->get()->pluck('mobile');
        } elseif($value=='teacher') {

            $user=User::where('designation', 'teacher')->get()->pluck('mobile');
            $contact[]=$user;
        }

        elseif(strpos($key, 'Class')!==false){

        $contact[]=Student::where('sectionId', $value)->get()->pluck('mobile');
// }            //$contact[]=Student::whereIn('sectionId', $value)->get()->pluck('mobile');
        }
    }
    $contact=implode(',',array_values(array_unique($contact)));
    return $contact;
   }
 }
