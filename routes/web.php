<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\model\Attendance;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin2', 'backend\AdminController@index')->name('admin.index');
// Route::get('/admin/sectionAttendance', 'backend\AdminController@sectionAttendance')->name('admin.sectionAttendance');
Route::get('/manage/classes', 'backend\ClassesController@index')->name('manage.class');

//admin deshboard api
Route::get('/api/search/totalstudent', 'backend\api\apiController@totalStudent')->name('api.totalStudent');
Route::get('api/search/StudentAttendancePercentage/{id}', 'backend\api\apiController@StudentAttendancePercentage')->name('api.StudentAttendancePercentage');
Route::get('api/search/totalTeacher', 'backend\api\apiController@totalTeacher')->name('api.totalTeacher');
Route::get('api/search/totalUser', 'backend\api\apiController@totalUser')->name('api.totalUser');
Route::get('api/search/totalsection', 'backend\api\apiController@totalsection')->name('api.totalsection');
Route::get('api/search/classwishAttentage', 'backend\api\apiController@classwishAttentage')->name('api.classwishAttentage');
Route::get('api/search/sectionAttendance/{classId}/{sectionId}/{dateId}', 'backend\api\apiController@sectionAttendance')->name('api.sectionAttendance');

//student section api for attendance count
Route::get('api/search/present', 'backend\api\apiController@present')->name('api.present');
Route::get('api/search/absent', 'backend\api\apiController@absent')->name('api.absent');
//student section api for datatable
Route::get('/api/search/studentname', 'backend\api\apiController@studentname')->name('api.studentname');

//for mark
Route::post('/api/search/sectionbyclass', 'backend\api\apiController@sectionbyclass')->name('api.sectionbyclass');
Route::post('/api/search/classsubject', 'backend\api\apiController@classsubject')->name('api.classsubject');

//result published
Route::get('/api/search/subjectListFromMarkTable', 'backend\api\apiController@subjectListFromMarkTable')->name('api.subjectListFromMarkTable');

//find fee list for class
Route::get('/api/search/classfeelist', 'backend\api\apiController@classfeelist')->name('api.classfeelist');

//find monthly fee list
Route::get('/api/search/classfeelistMonthly', 'backend\api\apiController@classfeelistMonthly')->name('api.feelistmonthly');


//find fee amount
Route::get('/api/search/feeamount', 'backend\api\apiController@feeamount')->name('api.feeamount');

Auth::routes();
//api routes

Route::group(['prefix' => 'api', 'namespace'=>'backend\api'], function () {
    Route::post('/search/section', 'apiController@section')->name('api.section');
    Route::get('/roleHasClassTeacher/{id}', 'apiController@roleHasClassTeacher')->name('api.roleHasClassTeacher');
    Route::get('/lastRoll/{sectionId}', 'apiController@lastRoll')->name('api.lastRoll');
    Route::get('/checkClassHasOptionalSubject/{classId}/{group}', 'apiController@checkClassHasOptionalSubject')->name('api.checkClassHasOptionalSubject');
});

//end api routes

//New Admin APi Section
Route::group(['namespace'=>'backend'], function () {
    Route::post('/student/attendance/studentData','Attendance\ApiAttendanceController@studentData')->name('studentData.attendence');

    //28/01/2019 ->student Attendance view
    Route::get('/attendance/show/{id}/{studentId}', 'Attendance\ApiAttendanceController@show')->name('apiattendence.show');
    Route::get('/attendance/attendancePercentage/{id}/{studentId}', 'Attendance\ApiAttendanceController@attendancePercentage')->name('apiattendence.attendancePercentage');

    Route::get('/getAllFeesByClass/{classId}/{sessionYearId}','fee\ApiFeeController@getAllFeesByClass')->name('getAllFeesByClass');

    Route::get('/absentlist', 'Attendance\ApiAttendanceController@absentlist')->name('absentData.absentlist');



});

//End Admin APi Section

//student login

Route::group(['prefix' => 'student', 'namespace'=>'Auth\student'], function () {
    Route::get('/login', 'LoginController@showLoginForm')->name('student.login');
    Route::post('/login', 'LoginController@login')->name('student.login');
    Route::post('/logout', 'LoginController@logout')->name('student.logout');
});

//student pages
Route::group(['prefix' => 'student', 'namespace'=>'backend\student'], function () {
    Route::get('/index', 'StudentController@index')->name('student.index');
    Route::get('/show/profile', 'StudentController@show')->name('student.show');
    Route::get('edit/profile','StudentController@edit')->name('student.edit.profile');
    Route::post('update/profile','StudentController@update')->name('student.update.profile');
    Route::post('/change/password','StudentController@changePassword')->name('change.password');
    Route::post('update/otherInfo','StudentController@otherInfo')->name('update.otherInfo');
    
    Route::get('/teacher/list', 'StudentTeacherListController@index')->name('student.teacherList');
    Route::get('/teacher/list/show', 'StudentTeacherListController@show')->name('student.teacherList.show');
    
    //home work
    Route::get('/homework/list', 'studenthomeworkController@index')->name('student.homeworklist');    
    Route::get('/homework/list/show', 'studenthomeworkController@show')->name('student.homeworklist.show');    

    Route::get('/subject/list', 'StudentSubjectListController@index')->name('student.subjectlist');
    
    Route::get('/class/classmates', 'StudentClassController@index')->name('student.classmates');
    Route::get('/class/classmates/show', 'StudentClassController@show')->name('student.classmates.show');
    
    Route::get('/totalstudent', 'StudentController@totalStudent')->name('student.totalStudent');


    Route::get('/attendance/index', 'StudentAttendanceController@index')->name('attendence.index');

    Route::get('/attendance/show/{id}', 'StudentAttendanceController@show')->name('attendence.show');
    Route::get('/attendance/attendancePercentage/{id}', 'StudentAttendanceController@attendancePercentage')->name('attendence.attendancePercentage');

    //School Corner
    Route::get('/school/corner', 'StudentController@schoolCorner')->name('school.corner');
    Route::get('/event/details', 'StudentController@eventDetails')->name('event.details');
    Route::get('/school/gallery', 'StudentController@gellary')->name('school.gallery');
    Route::get('/school/about', 'StudentController@about')->name('school.about');

    //Fee module
    Route::get('/student/fee/index','StudentFeeController@index')->name('student.fee.index');
    Route::get('/fee/show/{id}/{sessionYearId}', 'StudentFeeController@show')->name('student.fee.show');
    Route::get('/due/fee/show', 'StudentFeeController@dueFee')->name('student.due.fee');
    Route::get('/due2/fee/show/{id}/{sessionYearId}/{classId}', 'StudentFeeController@dueFee2')->name('student.due.fee2');

    //Result module
    Route::get('/result/index','StudentResultController@index')->name('student.result.index');
    Route::post('/result/list','StudentResultController@result')->name('student.result.list');

});
//endforstudent

//student pages for admin
Route::group(['middleware' => ['auth', 'role_or_permission:Student'], 'prefix'=>'mystudent', 'namespace'=>'backend'], function () {
    Route::get('/list/index', 'MyStudentConttroller@index')->name('mystudent.index');
    Route::get('/list', 'MyStudentConttroller@allstudentlist')->name('mystudent.allstudentlist');
    Route::get('/scholarship', 'MyStudentConttroller@scholarship')->name('scholarship.index');
    Route::get('/scholarship/list', 'MyStudentConttroller@scholarshiplist')->name('scholarship.list');
    Route::get('/classwise', 'MyStudentConttroller@classwise')->name('mystudent.classwise');
    Route::get('/classwiseList/{id}/{sessionYearId}', 'MyStudentConttroller@classwiseList')->name('mystudent.classwiseList');
    Route::get('/student/delete/{id}','MyStudentConttroller@destroy')->name('student.delete');


    Route::get('/sectionwise', 'MyStudentConttroller@Sectionwise')->name('mystudent.sectionwise');
    Route::get('/sectionwiselist/{classId}/{sectionId}/{sessionYearId}', 'MyStudentConttroller@sectionwiselist')->name('mystudent.sectionwiselist');


    
    



});
//Student profile Student || class Teacher
Route::group(['middleware' => ['auth', 'role_or_permission:Student|Class Teacher'], 'prefix'=>'mystudent', 'namespace'=>'backend'], function () {
    Route::get('/show/studentProfile/{id}', 'MyStudentConttroller@show')->name('mystudent.showProfile');
    Route::get('edit/studentProfile/{id}','MyStudentConttroller@edit')->name('mystudent.editProfile');
    Route::post('update/studentProfile/{id}','MyStudentConttroller@update')->name('mystudent.update');

    //subject List
    Route::get('mystudent/subject/list/{id}', 'MyStudentConttroller@subjectList')->name('mystudent.subjectlist');

    //credintial List
    Route::get('/list/credentialIndex', 'MyStudentConttroller@credentialIndex')->name('mystudent.credentialIndex');
    Route::get('/credential/list', 'MyStudentConttroller@credentiallist')->name('mystudent.credential');

    Route::post('/change/password','MyStudentConttroller@changePassword')->name('mystudent.change.password');

    //all student list
    Route::get('/allstudent', 'MyStudentConttroller@allstudent')->name('allstudent.index');
    Route::get('/list', 'MyStudentConttroller@allstudentlist')->name('mystudent.allstudentlist');

    

});
//only for Super Admin
Route::group(['middleware' => ['auth', 'role_or_permission:Super Admin']], function () {
    Route::post('/addSchoolBranch/store', 'backend\UserController@addSchoolBranch')->name('addSchoolBranch.store');
    Route::get('/createSchoolBranch', 'backend\UserController@createSchoolBranch')->name('createSchoolBranch');
    Route::get('/requestedUser', 'backend\UserController@requestedUser')->name('requestedUser');
    Route::get('/requestedUserData', 'backend\UserController@requestedUserData')->name('requestedUserData');
    Route::get('/accepRequestedUser', 'backend\UserController@requestedUserData')->name('requestedUserData');
});


//

//open route
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/applyInstitute', 'ApplyInstituteController@create')->name('applyInstitute');
Route::get('/getUpazilaByDistrict', 'ApplyInstituteController@getUpazilaByDistrict')->name('getUpazilaByDistrict');
Route::post('/applyInstitute/store', 'ApplyInstituteController@store')->name('applyInstitute.store');
Route::get('/createPermission', 'backend\UserController@createPermission')->name('createPermission');
Route::post('/addPermission', 'backend\UserController@addPermission')->name('addPermission');
//end open route



//userManagement
//user profile Open
Route::group(['namespace'=>'backend'], function () {
    Route::get('/show/Userprofile/{id?}', 'UserController@show')->name('user.show');
    Route::get('user/edit/profile/{id?}','UserController@edit')->name('userEditProfile');
    Route::post('user/update/profile/{id?}','UserController@update')->name('userUpdate.profile');
    Route::post('/user/change/password/{id?}','UserController@changePassword')->name('userChange.password');
    Route::post('/user/updateRole//{id?}','UserController@updateRole')->name('updateRole');
});

//user file method
    Route::get('/file/store','backend\file\FileController@applyFile')->name('file.apply');
    Route::post('/file/store/document','backend\file\FileController@fileStore')->name('file.store');
    Route::get('/file/datatable/','backend\file\FileController@fileData');
    //Route::get('/download/file/{id}','backend\file\FileController@bookDownload')->name('book.download');



Route::group(['middleware' => ['auth','role_or_permission:User Management'], 'namespace'=>'backend'], function () {
    Route::get('/create/userAndRole', 'UserController@createUserAndRole')->name('createUserAndRole');
    Route::get('/userAndRole/list', 'UserController@UserAndRoleList')->name('UserAndRole.list');
    Route::post('/add/userAndRole', 'UserController@addUserAndRole')->name('addUserAndRole');
    Route::get('/createRole', 'UserController@createRole')->name('createRole');
    Route::post('/addRole', 'UserController@addRole')->name('addRole');
    Route::post('/updateRolePermission', 'UserController@updateRolePermission')->name('updateRolePermission');
    Route::get('/editRolePermission', 'UserController@editRolePermission')->name('editRolePermission');



});

Route::group(['middleware' => ['api']], function () {
    Route::post('/add/userAndRole', 'backend\UserController@addUserAndRole')->name('addUserAndRole');
});

//Admission
Route::group(['middleware' => ['auth','role_or_permission:Admission'],'prefix'=>'admission', 'namespace'=>'backend'], function () {

    Route::get('/','AdmissionController@index')->name('admissison.index');
    Route::post('/store','AdmissionController@store')->name('admission.store');
    Route::get('/last/admission','AdmissionController@lastAdmission')->name('lastAdmission');

});

//class Management
Route::group(['middleware' => ['auth','role_or_permission:Class']], function () {

    Route::get('/class','backend\ClassesController@index')->name('class.index');
    Route::post('/class/store','backend\ClassesController@store')->name('class.store');
    Route::get('/class/show','backend\ClassesController@show')->name('class.show');
    Route::get('/class/edit/{id}','backend\ClassesController@edit')->name('class.edt');
    Route::post('/class/update/{id}','backend\ClassesController@update')->name('class.update');
    Route::get('/class/delete/{id}','backend\ClassesController@destroy')->name('class.delete');
});

Route::group(['middleware' => ['auth','role_or_permission:Fee Management'], 'namespace'=>'backend\fee'], function () {
    //Fee Management for admin
    Route::get('/fee','FeeController@index')->name('fee.index');
    Route::post('/fee/store','FeeController@store')->name('fee.store');
    Route::get('/fee/show','FeeController@show')->name('fee.show');
    Route::get('/fee/edit/{id}','FeeController@edit')->name('fee.edt');
    Route::post('/fee/update/{id}','FeeController@update')->name('fee.update');
    Route::get('/fee/delete/{id}','FeeController@destroy')->name('fee.delete');


});

 //feeHisory admin view
 Route::get('/feehistory','backend\FeeHistoryController@index')->name('feehistory.index');
 Route::get('/feehistory/show','backend\FeeHistoryController@show')->name('feehistory.show');

//Fee management
Route::group(['middleware' => ['auth','role_or_permission:Fee Collection']], function () {

    //feecollection management for admin
    Route::get('/feecollection','backend\FeeCollectionController@index')->name('feecollection.index');
    Route::post('/feecollection/student/Data','backend\FeeCollectionController@student')->name('feecollection.studentdata');
    Route::post('/feecollection/store','backend\FeeCollectionController@store')->name('store.feecollection');
    Route::post('/feecollection/update','backend\FeeCollectionController@update')->name('update.feecollection');

    //individual fee Collection Management for admin
    Route::get('/feecollection/individual','backend\FeeCollectionController@individualCollection')->name('individualFee.individualCollection');
    //Route::post('/feecollection/individualStudent','backend\FeeCollectionController@individualStudent')->name('individualFee.individualStudent');
    Route::post('/feecollection/individualStudent2','backend\FeeCollectionController@individualStudent2')->name('individualFee.individualStudent2');
    Route::post('/feecollection/individualStudentfind','backend\FeeCollectionController@individualStudentfind')->name('individualFee.individualStudentfind');

    //Route::get('/feecollection/scholarshipAmount','backend\FeeCollectionController@scholarshipAmount')->name('individualFee.scholarshipAmount');
    Route::post('/feecollection/individual/store','backend\FeeCollectionController@storeIndividualy')->name('store.individualFeecollection');
    Route::post('/feecollection/individual/update','backend\FeeCollectionController@updateIndividualStudent')->name('update.individualFeecollection');

    //For more then one month
    Route::get('/feecollection/individual/monthly','backend\FeeCollectionController@monthlyindex')->name('monthly.index');
    Route::get('/feecollection/individual/findMonth','backend\FeeCollectionController@findMonth')->name('find.month');
    Route::post('/feecollection/individual/findmonthlyyearlyfee','backend\FeeCollectionController@findMonthForAdvancefeeCollection')->name('find.monthlyoryearly');
    Route::post('/feecollection/individual/monthly/store','backend\FeeCollectionController@storeMorethenOneMonth')->name('store.storeMorethenOneMonth');


    //Student Fee Details (feeCollection)
    Route::get('/feecollection/student/feeDetails','backend\FeeCollectionController@studentFeeDetails')->name('student.feeDetails');
    //Route::get('/feecollection/individualStudentDetails','backend\FeeCollectionController@individualFeeDetails')->name('individualStudent.feeDtails');
    //Route::get('/feecollection/details/show/{month}/{studentId}/{sessionYearId}/{classId}', 'backend\FeeCollectionController@dueDetailsFee')->name('individualStudent.studentDue.fees');
    //Route::get('/feecollection/studentMonthly/paiedFee/{month}/{studentId}','backend\FeeCollectionController@studentMonthlyPaiedFee')->name('student.monthlyPaiedFee');

    //payment
    Route::get('/feecollection/student/payment','backend\FeeCollectionController@payment')->name('payment.index');
    Route::get('/payment/details/show/{month}/{studentId}/{sessionYearId}/{classId}', 'backend\FeeCollectionController@paymentDetailsFee')->name('individualStudent.studentDue.fees');

    //Admin Report
    Route::get('/feemanagement/report/sectionwise','backend\FeeManagementReportController@index')->name('feemanagementreport.index');
    //Route::post('/feemanagement/report/sectionwise/feedetails','backend\FeeManagementReportController@feedetails')->name('report.feedetails');
    Route::get('/feemanagement/report/sectionwise/show/{month}/{sessionYearId}','backend\FeeManagementReportController@show')->name('detail.show');

});

// Class Teacher | fee Collection
Route::group(['middleware' => ['auth','role_or_permission:Fee Collection|Class Teacher']], function () {
    Route::post('/feecollection/individualStudent','backend\FeeCollectionController@individualStudent')->name('individualFee.individualStudent');
    Route::post('/feecollection/individual/findmonthlyyearlyfee','backend\FeeCollectionController@findMonthForAdvancefeeCollection')->name('find.monthlyoryearly');
    //Route::post('/feecollection/individual/monthly/store','backend\FeeCollectionController@storeMorethenOneMonth')->name('store.storeMorethenOneMonth');
    Route::post('/feemanagement/report/sectionwise/feedetails','backend\FeeManagementReportController@feedetails')->name('report.feedetails');

    //student fee report details(classTeacher)
    Route::get('/feecollection/individualStudentDetails','backend\FeeCollectionController@individualFeeDetails')->name('individualStudent.feeDtails');
    Route::get('/feecollection/details/show/{month}/{studentId}/{sessionYearId}/{classId}', 'backend\FeeCollectionController@dueDetailsFee')->name('individualStudent.studentDue.fees');

});


//section Management
Route::group(['middleware' => ['auth','role_or_permission:Section']], function () {

    Route::get('/section','backend\SectionController@index')->name('section.index');
    Route::post('/section/store','backend\SectionController@store')->name('section.store');
    Route::get('/section/show','backend\SectionController@show')->name('section.show');
    Route::get('/section/edit/{id}','backend\SectionController@edit')->name('section.edt');
    Route::post('/section/update/{id}','backend\SectionController@update')->name('section.update');
    Route::get('/section/delete/{id}','backend\SectionController@destroy')->name('section.delete');

});

//sessionYear Management
Route::group(['middleware' => ['auth','role_or_permission:SessionYear']], function () {

    Route::get('/sessionyear','backend\SessionYearController@index')->name('sessionyear.index');
    Route::post('/sessionyear/store','backend\SessionYearController@store')->name('sessionyear.store');
    Route::get('/sessionyear/show','backend\SessionYearController@show')->name('sessionyear.show');
    Route::get('/sessionyear/edit/{id}','backend\SessionYearController@edit')->name('sessionyear.edt');
    Route::post('/sessionyear/update/{id}','backend\SessionYearController@update')->name('sessionyear.update');
    Route::get('/sessionyear/delete/{id}','backend\SessionYearController@destroy')->name('sessionyear.delete');

});


//group Management
Route::group(['middleware' => ['auth','role_or_permission:Group']], function () {

    Route::get('/group','backend\GroupController@index')->name('group.index');
    Route::post('/group/store','backend\GroupController@store')->name('group.store');
    Route::get('/group/show','backend\GroupController@show')->name('group.show');
    Route::get('/group/edit/{id}','backend\GroupController@edit')->name('group.edt');
    Route::post('/group/update/{id}','backend\GroupController@update')->name('group.update');
    Route::get('/group/delete/{id}','backend\GroupController@destroy')->name('group.delete');

});

//subject Management
Route::group(['middleware' => ['auth','role_or_permission:Subject']], function () {

    Route::get('/subject','backend\SubjectController@index')->name('subject.index');
    Route::post('/subject/store','backend\SubjectController@store')->name('subject.store');
    Route::get('/subject/show','backend\SubjectController@show')->name('subject.show');
    Route::get('/subject/edit/{id}','backend\SubjectController@edit')->name('subject.edt');
    Route::post('/subject/update/{id}','backend\SubjectController@update')->name('subject.update');
    Route::get('/subject/delete/{id}','backend\SubjectController@destroy')->name('subject.delete');
});

//admission Management


//

//Attendance Management
Route::group(['middleware' => ['auth','role_or_permission:Attendance|Class Teacher'],'namespace'=>'backend\Attendance'], function () {
    Route::get('/student/attendance','AttendanceController@index')->name('attendance.index');
    Route::post('/student/attendance/store','AttendanceController@storeAttendence')->name('store.attendence');
    Route::get('/student/attendance/edit/{sectionId}','AttendanceController@edit')->name('attendance.edit');

    Route::get('/student/attendance/classwish','AttendanceController@classwish')->name('attendance.classwish');

    Route::get('/student/attendance/bydate','AttendanceController@bydate')->name('attendance.bydate');

    //Route::post('/student/attendance/studentDatabydate','AttendanceController@studentDatabydate')->name('attendance.studentDatabydate');
    //Route::get('/student/attendance/datewishAttendance/{dateId}/{sectionId}','AttendanceController@datewishAttendance')->name('attendance.datewishAttendance');

    //28/01/2019 -> student attendance view
    Route::get('/student/attendance/studentviewindex/{id}', 'AttendanceController@studentView')->name('studentviewindex.index');


});

//Attendance |class Teacher
Route::group(['middleware' => ['auth','role_or_permission:Attendance|Class Teacher'],'namespace'=>'backend\Attendance'], function () {
    Route::post('/student/attendance/studentDatabydate','AttendanceController@studentDatabydate')->name('attendance.studentDatabydate');
    Route::get('/student/attendance/datewishAttendance/{dateId}/{sectionId}','AttendanceController@datewishAttendance')->name('attendance.datewishAttendance');
    Route::post('/student/attendance/update','AttendanceController@update')->name('update.attendence');
});

 //Class Teacher option
 Route::group(['middleware' => ['auth','role_or_permission:Class Teacher']], function () {

    //attendance
    Route::get('/myclass/attendance','backend\ClassTeacherController@myclassattendance')->name('myclass.attendance');
    Route::post('/myclass/attendance/store','backend\ClassTeacherController@storeAttendence')->name('myclass.store');
    Route::get('/student/attendance/edit/{sectionId}','backend\ClassTeacherController@edit')->name('myclass.edit');
    Route::post('/myclass/attendance/update','backend\ClassTeacherController@update')->name('myclass.update');

    //Attendance by Date
    Route::get('/myclass/attendancebydate','backend\ClassTeacherController@myclassattendancebydate')->name('myclass.attendancebydate');
    //Route::post('/myclass/attendance/update','backend\ClassTeacherController@update')->name('myclass.update');

    //feecollection
    Route::get('/myclass/feecollection','backend\ClassTeacherController@myclassfeecollection')->name('myclass.feecollection');
    Route::post('/myclass/student/Data','backend\ClassTeacherController@student')->name('myclass.studentdata');
    Route::post('/myclass/feecollection/store','backend\ClassTeacherController@storefeecollection')->name('myclass.feecollection.store');
    Route::post('/myclass/update','backend\ClassTeacherController@updatefeecollection')->name('myclass.feecollection.update');

    //Individual Fecollection
    Route::get('/myclass/feecollection/individual','backend\ClassTeacherController@myclassIndividualFeeCollection')->name('myclass.feecollection.individual');
    Route::post('myclass/feecollection/individual/monthly/store','backend\ClassTeacherController@myclassStoreMonthly')->name('myclass.storeMonthly');


    //student list
    Route::get('/myclass/studentlist','backend\ClassTeacherController@studentlist')->name('myclass.studentlist');
    Route::get('/myclass/sectionwiselist/{classId}/{sectionId}/{sessionYearId}','backend\ClassTeacherController@sectionwiselist')->name('myclass.sectionwiselist');
    Route::get('myclass/show/studentProfile/{id}', 'backend\ClassTeacherController@showstudentprofile')->name('myclass.showStudentProfile');
    Route::get('/myclass/student/delete/{id}','backend\ClassTeacherController@studentdestroy')->name('myclass.student.delete');

    //Monthly Fee Report
    Route::get('/myclass/monthlyfeereport','backend\ClassTeacherController@monthlyFeeReport')->name('myclass.monthlyfee.report');
    Route::get('/myclass/monthly/feereport/show/{month}/{sessionYearId}/{sectionId}','backend\ClassTeacherController@monthlyFeeReportDetails')->name('myclass.monthlyfee.detail');

    //Monthly Student Report
    Route::get('/myclass/monthly/student/feereport','backend\ClassTeacherController@monthlyStudentFeeReport')->name('myclass.studentfee.report');

    //myclass credintial List
    Route::get('myclass/list/credentialIndex', 'backend\ClassTeacherController@credentialIndex')->name('myclass.credentialIndex');
    Route::get('myclass/credential/list/{classId}/{sectionId}/{sessionYearId}', 'backend\ClassTeacherController@credentiallist')->name('myclass.credential'); 

    //schoershiplist
    Route::get('myclass/list/scholarship', 'backend\ClassTeacherController@scholarShipIndex')->name('myclass.schoarship');
    Route::get('myclass/schoarship/list/{classId}/{sectionId}/{sessionYearId}', 'backend\ClassTeacherController@scholarshiplist')->name('myclass.scholarshiplist');

});

//Marks Distribution
Route::group(['middleware' => ['auth','role_or_permission:Mark']], function () {
    Route::get('adminview/student/marksdistribution','backend\MarksDistributionController@index')->name('marks.index');
    Route::get('adminview/student/sectionwiselist/{classId}/{sectionId}', 'backend\MarksDistributionController@sectionwiselist')->name('mystudent.sectionwiselist');
    Route::post('adminview/student/studenlist','backend\MarksDistributionController@studenlist')->name('studentlist.mark');
    Route::post('adminview/student/markstore','backend\MarksDistributionController@storemark')->name('store.mark');


});

//Result management
    Route::get('adminview/student/result','backend\resultController@index')->name('result.index');
    Route::post('/adminview/student/resultlist','backend\resultController@resultlist')->name('resultlist.resultlist');



//Promotion management 
    Route::get('adminview/student/promotion','backend\PromotionController@index')->name('promotion.index');
    Route::get('adminview/student/promotionlist/{classId}/{sectionId}/{sessionYearId}', 'backend\PromotionController@studentlist')->name('promotion.studentlist');
    Route::post('adminview/promotionlist/store','backend\PromotionController@store')->name('promotion.store');




//Result PUblished
    Route::get('adminview/student/resultPublished','backend\ResultPublish@index')->name('resultPublished.index');
    Route::post('adminview/student/resultPublished/update','backend\ResultPublish@update')->name('update.published');

//Exam attendance
    Route::get('adminview/student/examattendance','backend\MarksDistributionController@examattendanceindex')->name('examattendance.index');
    Route::post('adminview/student/studentData','backend\MarksDistributionController@studentData')->name('studentData.mark');
    Route::post('adminview/student/examattendance/store','backend\MarksDistributionController@examattendancestore')->name('examattendance.store');
    Route::post('adminview/student/examattendance/update','backend\MarksDistributionController@examattendanceupdate')->name('examattendance.update');


//Exam management
    Route::get('/exam','backend\ExamController@index')->name('exam.index');
    Route::post('/exam/store','backend\ExamController@store')->name('exam.store');
    Route::get('/exam/show','backend\ExamController@show')->name('exam.show');
    Route::get('/exam/edit/{id}','backend\ExamController@edit')->name('exam.edt');
    Route::post('/exam/update/{id}','backend\ExamController@update')->name('exam.update');
    Route::get('/exam/delete/{id}','backend\ExamController@destroy')->name('exam.delete');

    //examlist
    Route::post('/exam/search/examlist', 'backend\ExamController@examlist')->name('api.examlist');

//homework management
    Route::get('/homework','backend\HomeworkController@index')->name('homework.index');
    Route::post('/homework/store','backend\HomeworkController@store')->name('homework.store');
    Route::get('/homework/show','backend\HomeworkController@show')->name('homework.show');
    Route::get('/homework/edit/{id}','backend\HomeworkController@edit')->name('homework.edt');
    Route::post('/homework/update/{id}','backend\HomeworkController@update')->name('homework.update');
    Route::get('/homework/delete/{id}','backend\HomeworkController@destroy')->name('homework.delete');


//schoolarship Management for admin
    Route::get('/schoolarship/Management','backend\ScholarshipController@index')->name('scholarship.management');
    Route::post('/schoolarship/store','backend\ScholarshipController@store')->name('scholarship.store');
    Route::get('/schoolarship/show','backend\ScholarshipController@show')->name('scholarship.show');
    Route::get('/schoolarship/edit/{id}','backend\ScholarshipController@edit')->name('scholarship.edt');
    Route::post('/schoolarship/update/{id}','backend\ScholarshipController@update')->name('scholarship.update');
    Route::get('/schoolarship/delete/{id}','backend\ScholarshipController@destroy')->name('scholarship.delete');

//student scholarship Management    
    Route::get('/schoolarship/list/student','backend\ScholarshipController@studentScholarshiplist')->name('student.scholarship');
    Route::get('/scholarship/list', 'backend\ScholarshipController@scholarshiplist')->name('scholarship.list');
    Route::post('/schoolarship/studentlist','backend\ScholarshipController@Studentlist')->name('studentlist.scholarship');
    Route::post('/schoolarship/feelist','backend\ScholarshipController@feelist')->name('feelist.scholarship');
    
    Route::post('/schoolarship/studentlist/store','backend\ScholarshipController@studentlistStore')->name('studentlist.schoarship.store');
    Route::get('/schoolarship/list/edit/{id}','backend\ScholarshipController@editstudentlist')->name('scholarship.studentlist.edt');
    Route::post('/scholarship/studentlist/update/{id}','backend\ScholarshipController@editstudentlist')->name('scholarship.studentlist.update');
    Route::get('/scholarship/studentlist/delete/{id}','backend\ScholarshipController@scholarshipdestroy')->name('schoarship.studentlist.delete');

//Notification
    Route::get('/notification/index','backend\notificationController@index')->name('notification.index');
    Route::get('/notification/notificationBoard','backend\notificationController@notificationBoard')->name('notification.board');
    Route::get('/notification/emailSms','backend\notificationController@notificationEmailSms')->name('notification.emailSms');
    Route::get('/notification/emailSmsLog','backend\notificationController@emailSmsLog')->name('notification.emailSmsLog');
    Route::get('notification/index','backend\notificationController@index')->name('notification.index');

//Grade management
    Route::get('/grade','backend\GradeController@index')->name('grade.index');
    Route::post('/grade/store','backend\GradeController@store')->name('grade.store');
    Route::get('/grade/show','backend\GradeController@show')->name('grade.show');
    Route::get('/grade/edit/{id}','backend\GradeController@edit')->name('grade.edt');
    Route::post('/grade/update/{id}','backend\GradeController@update')->name('grade.update');
    Route::get('/grade/delete/{id}','backend\GradeController@destroy')->name('grade.delete');

    //gradelist
    Route::post('/grade/search/gradelist', 'backend\GradeController@gradelist')->name('api.gradelist');

Route::get('/notification/index','backend\notificationController@index')->name('notification.index');
Route::get('/notification/notificationBoard','backend\notificationController@notificationBoard')->name('notification.board');
Route::get('/notification/emailSms','backend\notificationController@notificationEmailSms')->name('notification.emailSms');
Route::get('/notification/emailSmsLog','backend\notificationController@emailSmsLog')->name('notification.emailSmsLog');
Route::post('/notification/create','backend\notificationController@create')->name('notification.create');
//Report
Route::get('/classBased/income/report','backend\report\ReportController@classbasedReport')->name('classBased.income.Report');
Route::get('/dateWise/income/expanse/report','backend\report\ReportController@dateWiseIncomeExpanseReport')->name('dateWise.income.expanse');
Route::get('grade/based/result/report','backend\report\ReportController@gradeBasedResultReport')->name('grade.result.report');
Route::get('section/based/attendence/report','backend\report\ReportController@sectionBasedAttendenceRe')->name('section.attendence.report');
Route::get('staff/attendence/report','backend\report\ReportController@staffAttendenceRe')->name('staff.attendence.report');


//permission and role


//misuk 03/019/2020

//Student Admit Card Generate By admin
Route::get('/sectionwise/student/admitCard', 'backend\AdmitCardController@AdmitCardController')->name('student.admit.card');
Route::get('/student/admitCardSectionWiseList/{classId}/{sectionId}/{examName}', 'backend\AdmitCardController@sectionwiselist')->name('student.sectionwiselist');

Route::get('/sectionwise/individual/student/admitCard', 'backend\AdmitCardController@individualAdmitCardController')->name('individual.admit.card');
Route::get('/individual/admitCardSectionWiseList/{classId}/{sectionId}', 'backend\AdmitCardController@individualsectionwiselist')->name('individual.sectionwiselist');

Route::get('/print/studentAdmitCard/{id}/{examName}', 'backend\AdmitCardController@AdmitCardPrint')->name('print.admit');

//Seat plan
Route::get('/student/SeatPlan', 'backend\SeatPlanController@seatPlan')->name('seat.plan');
Route::get('/student/seatPlanPrint/{classId}/{sectionId}/{examName}/{room}', 'backend\SeatPlanController@seatPlanPrint')->name('print.seat.plan');

