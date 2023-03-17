<aside class="app-sidebar">
      <div class="app-sidebar__user">
      @foreach(App\model\File::where('userId', Auth::guard()->user()->id)->where('type','profile')->get() as $fill)
      @if(!empty($fill))
            <img class="app-sidebar__user-avatar" src="{{asset('users/'.$fill->image)}}" style="width: 25%; height: 25%;">
          @else
            <img class="app-sidebar__user-avatar" src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg" style="width: 25%; height: 25%;" alt="User Image">
        @endif
      @endforeach
        <div>
          <span class="text-info">Welcome,</span>
          <p class="app-sidebar__user-name">{{Auth::guard('web')->user()->name}}</p>
          <p class="app-sidebar__user-designation">{{Auth::guard('web')->user()->designation}}</p>
        </div>
      </div>
      <ul class="app-menu">
      <li><a class="app-menu__item active" href="{{route('admin.index') }}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>

        {{-- cheking admin --}}
        @if (Auth::guard('web')->check())

        @can('Super Admin')
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label text-warning">Super Admin</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="{{route('createSchoolBranch')}}"><i class="icon fa fa-angle-right"></i>Create School Branch</a></li>
                <li><a class="treeview-item" href="{{route('requestedUser')}}"><i class="icon fa fa-angle-right"></i>Requested School</a></li>
                <li><a class="treeview-item" href="{{route('createUserAndRole')}}"><i class="icon fa fa-angle-right"></i>Add User</a></li>
                <li><a class="treeview-item" href="{{route('createPermission')}}"><i class="icon fa fa-angle-right"></i>Permission</a></li>
                {{-- <li><a class="treeview-item" href="bootstrap-components.html"><i class="icon fa fa-circle-o"></i>ALL User</a></li> --}}
            </ul>
          </li>
          @endcan

          <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="fa fa-cog fa-spin fa-fw"></i><span class="app-menu__label">Settings</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="{{route('user.show',[Auth::guard('web')->user()->id])}}"><i class="icon fa fa-angle-right"></i>My Profile</a></li>

            </ul>
          </li>
        {{-- end superadmin --}}

        {{-- //Start user Management --}}
        @can('User Management')
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class=""></i><span class="app-menu__label">Employee Management</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
              {{-- <li><a class="treeview-item" href="bootstrap-components.html"><i class="icon fa fa-angle-right"></i>My User & Password</a></li> --}}
                <li><a class="treeview-item" href="{{route('createUserAndRole')}}"><i class="icon fa fa-angle-right"></i>Add User</a></li>
              <li><a class="treeview-item" href="{{route('createRole')}}"><i class="icon fa fa-angle-right"></i>Role & Permissions</a></li>
            </ul>
          </li>
          @endcan

          @can('SessionYear')
          <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><span class="app-menu__label">Session Year</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
              <li><a class="treeview-item" href="{{route('sessionyear.index') }}"><i class="icon fa fa-angle-right"></i>Session year</a></li>
          </ul>
          </li>
          @endcan

          @can('Class')
            <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class=""></i><span class="app-menu__label">Class</span><i class="treeview-indicator fa fa-angle-right"></i></a>
              <ul class="treeview-menu">
                <li><a class="treeview-item" href="{{ route('class.index') }}"><i class="icon fa fa-angle-right"></i>Class</a></li>
              </ul>
            </li>
            @endcan

              @can('Section')
            <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><span class="app-menu__label">Section</span><i class="treeview-indicator fa fa-angle-right"></i></a>
              <ul class="treeview-menu">
                <li><a class="treeview-item" href="{{route('section.index') }}"><i class="icon fa fa-angle-right"></i>Section</a></li>
              </ul>
            </li>
            @endcan
            @can('Subject')
            <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><span class="app-menu__label">Subject</span><i class="treeview-indicator fa fa-angle-right"></i></a>
              <ul class="treeview-menu">
                <li><a class="treeview-item" href="{{route('subject.index') }}"><i class="icon fa fa-angle-right"></i>Subject</a></li>
              </ul>
            </li>
            @endcan
            @can('Fee Management')
            <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><span class="app-menu__label">Fee Management</span><i class="treeview-indicator fa fa-angle-right"></i></a>
              <ul class="treeview-menu">
                <li><a class="treeview-item" href="{{route('fee.index') }}"><i class="icon fa fa-angle-right"></i>Manage Fee </a></li>
                <li><a class="treeview-item" href="{{route('feehistory.index') }}"><i class="icon fa fa-angle-right"></i>Fee Update History </a></li>

              </ul>
            </li>
            @endcan
            @can('Scholarship')
            <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><span class="app-menu__label">Scholarship Management</span><i class="treeview-indicator fa fa-angle-right"></i></a>
              <ul class="treeview-menu">
                <li><a class="treeview-item" href="{{route('scholarship.management')}}"><i class="icon fa fa-angle-right"></i>Schoolarship</a></li>
                 <li><a class="treeview-item" href="{{route('student.scholarship')}}"><i class="icon fa fa-angle-right"></i>Student Schoolarship list </a></li>
              </ul>
            </li>
            @endcan

          @can('Class Teacher')
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class=""></i><span class="app-menu__label">My Class</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="nav nav-pills flex-column treeview-menu">           
            <li class="nav-item">
                <a class="nav-link collapsed" href="#submenu1" data-toggle="collapse" data-target="#submenu1" style="color:white;">Attendance</a>
                <div class="collapse" id="submenu1" aria-expanded="false">
                    <ul class="flex-column pl-2 nav">
                      {{-- second step --}}
                        <li class="nav-item"><a class="nav-link py-0" href="{{route('myclass.attendance')}}" style="color:#ffbc00;">Today Attendance</a></li>
                        <li class="nav-item"><a class="nav-link py-0" href="{{route('myclass.attendancebydate')}}" style="color:#ffbc00;">Date-wise Attendance</a></li>
                        {{-- third step example  --}}
                        {{-- <li class="nav-item">
                            <a class="nav-link collapsed py-0" href="#submenu1sub1" data-toggle="collapse" data-target="#submenu1sub1">Customers</a>
                            <div class="collapse small" id="submenu1sub1" aria-expanded="false">
                                <ul class="flex-column nav pl-4">
                                    <li class="nav-item">
                                        <a class="nav-link p-0" href="">
                                            <i class="fa fa-fw fa-clock-o"></i> Daily
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link p-0" href="">
                                            <i class="fa fa-fw fa-dashboard"></i> Dashboard
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link p-0" href="">
                                            <i class="fa fa-fw fa-bar-chart"></i> Charts
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link p-0" href="">
                                            <i class="fa fa-fw fa-compass"></i> Areas
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li> --}}
                    </ul>
                </div>
            </li>
            <li class="nav-item">
              <a class="nav-link collapsed" href="#submenu2" data-toggle="collapse" data-target="#submenu2" style="color:white;">Fee Collection</a>
              <div class="collapse" id="submenu2" aria-expanded="false">
                  <ul class="flex-column pl-2 nav">
                    {{-- second step --}}
                      <li class="nav-item"><a class="nav-link py-0"  href="{{route('myclass.feecollection')}}" style="color:#ffbc00;">Total Fee Collection</a></li>
                      <li class="nav-item"><a class="nav-link py-0" href="{{route('myclass.feecollection.individual')}}" style="color:#ffbc00;">Individual Fee Collection </a></li>
                  </ul>
              </div>
          </li>
          <li class="nav-item">
            <a class="nav-link collapsed" href="#submenu3" data-toggle="collapse" data-target="#submenu3" style="color:white;">Student</a>
            <div class="collapse" id="submenu3" aria-expanded="false">
                <ul class="flex-column pl-2 nav">
                  {{-- second step --}}
                    <li class="nav-item"><a class="nav-link py-0"  href="{{route('myclass.studentlist')}}" style="color:#ffbc00;">Student List</a></li>
                    <li class="nav-item"><a class="nav-link py-0" href="{{route('myclass.schoarship') }}" style="color:#ffbc00;"> Scholarship List</a></li>
                    <li class="nav-item"><a class="nav-link py-0" href="{{route('myclass.credentialIndex') }}" style="color:#ffbc00;">Student Credential List</a></li>
                    {{-- <li class="nav-item"><a class="nav-link py-0" href="{{route('mystudent.credentialIndex') }}" style="color:#ffbc00;">All Student Credential</a></li> --}}
                     <li class="nav-item"><a class="nav-link py-0" href="{{route('allstudent.index') }}"  style="color:#ffbc00;">All Student list</a></li>

                </ul>
            </div>
        </li>
        <li class="nav-item">
          <a class="nav-link collapsed" href="#submenu3" data-toggle="collapse" data-target="#submenu4" style="color:white;">Fee Report</a>
          <div class="collapse" id="submenu4" aria-expanded="false">
              <ul class="flex-column pl-2 nav">
                {{-- second step --}}
                  <li class="nav-item"><a class="nav-link py-0"  href="{{route('myclass.monthlyfee.report')}}" style="color:#ffbc00;">Monthly Fee Report</a></li>
                  <li class="nav-item"><a class="nav-link py-0" href="{{route('myclass.studentfee.report')}}" style="color:#ffbc00;">Student Fee Report</a></li>
              </ul>
          </div>
      </li>
    <!--  <li class="nav-item">-->
    <!--    <a class="nav-link collapsed" href="#submenu3" data-toggle="collapse" data-target="#submenu5" style="color:white;">Admit Card</a>-->
    <!--    <div class="collapse" id="submenu5" aria-expanded="false">-->
    <!--        <ul class="flex-column pl-2 nav">-->
    <!--          {{-- second step --}}-->
              
    <!--            <li class="nav-item"><a class="nav-link py-0"  href="{{route('student.admit.card') }}" style="color:#ffbc00;">Sectionwise Admit Card</a></li>-->
    <!--            <li class="nav-item"><a class="nav-link py-0" href="{{route('individual.admit.card') }}" style="color:#ffbc00;">Individual Admit Card</a></li>-->
    <!--        </ul>-->
    <!--    </div>-->
    <!--</li>-->
    <!--<li class="nav-item">-->
    <!--  <a class="nav-link collapsed" href="#submenu3" data-toggle="collapse" data-target="#submenu6" style="color:white;">Seat Plan</a>-->
    <!--  <div class="collapse" id="submenu6" aria-expanded="false">-->
    <!--      <ul class="flex-column pl-2 nav">-->
    <!--        {{-- second step --}}-->
            
    <!--          <li class="nav-item"><a class="nav-link py-0"  href="{{route('seat.plan') }}" style="color:#ffbc00;">Sectionwise Seat Plan</a></li>-->
    
    <!--      </ul>-->
    <!--  </div>-->
    <!--</li>-->
    <!--<li class="nav-item">-->
    <!--  <a class="nav-link collapsed" href="#submenu3" data-toggle="collapse" data-target="#submenu7" style="color:white;">Result</a>-->
    <!--  <div class="collapse" id="submenu7" aria-expanded="false">-->
    <!--      <ul class="flex-column pl-2 nav">-->
    <!--        {{-- second step --}}-->
            
    <!--          <li class="nav-item"><a class="nav-link py-0"  href="{{route('result.index') }}" style="color:#ffbc00;">Individual Result</a></li>-->
    
    <!--      </ul>-->
    <!--  </div>-->
    <!--</li>-->
    <!--<li class="nav-item">-->
    <!--  <a class="nav-link collapsed" href="#submenu3" data-toggle="collapse" data-target="#submenu8" style="color:white;">Promotion</a>-->
    <!--  <div class="collapse" id="submenu8" aria-expanded="false">-->
    <!--      <ul class="flex-column pl-2 nav">-->
    <!--        {{-- second step --}}-->
            
    <!--          <li class="nav-item"><a class="nav-link py-0"  href="{{route('promotion.index') }}" style="color:#ffbc00;"> Sectionwise Promotion</a></li>-->
    
    <!--      </ul>-->
    <!--  </div>-->
    <!--</li>-->
    

        </ul>     
          </li>
          @endcan

          @can('Admission')

          <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><span class="app-menu__label">Admission</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
              <li><a class="treeview-item" href="{{route('admissison.index') }}"><i class="icon fa fa-angle-right"></i>Admission</a></li>
            </ul>
          </li>
          @endcan

          @can('Student')
          <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class=""></i><span class="app-menu__label">Student</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
              <li><a class="treeview-item" href="{{route('mystudent.index') }}"><i class="icon fa fa-angle-right"></i>All Student</a></li>
              <li><a class="treeview-item" href="{{route('mystudent.credentialIndex') }}"><i class="icon fa fa-angle-right"></i>Student Credential</a></li>
              <li><a class="treeview-item" href="{{route('mystudent.classwise') }}"><i class="icon fa fa-angle-right"></i>Class Wise Student</a></li>
              {{-- <li><a class="treeview-item" href="{{route('section.index') }}"><i class="icon fa fa-angle-right"></i>Previous Student</a></li> --}}
              <li><a class="treeview-item" href="{{route('mystudent.sectionwise') }}"><i class="icon fa fa-angle-right"></i>Section Wise Student</a></li>
              <li><a class="treeview-item" href="{{route('scholarship.index') }}"><i class="icon fa fa-angle-right"></i>Scholarship list </a></li>
            </ul>
          </li>
          @endcan

          @can('Attendance')

          <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class=""></i><span class="app-menu__label">Student Attendance</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
              <li><a class="treeview-item" href="{{route('attendance.index') }}"><i class="icon fa fa-angle-right"></i>Today Attendance </a></li>
              <!-- <li><a class="treeview-item" href="{{route('attendance.classwish') }}"><i class="icon fa fa-angle-right"></i>class wish</a></li> -->
              <li><a class="treeview-item" href="{{route('attendance.bydate') }}"><i class="icon fa fa-angle-right"></i>Datewish Attendance</a></li>
            </ul>
          </li>
          @endcan

          @can('Fee Collection')
          <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><span class="app-menu__label">Fee Collection</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">

              <li><a class="treeview-item" href="{{route('feecollection.index') }}"><i class="icon fa fa-angle-right"></i> Section Wise Fee</a></li>
           {{--     <li><a class="treeview-item" href="{{route('individualFee.individualCollection') }}"><i class="icon fa fa-angle-right"></i>Individual Fee</a></li>  --}}
              <li><a class="treeview-item" href="{{route('monthly.index') }}"><i class="icon fa fa-angle-right"></i>Individual Fee Collection</a></li>
              <li><a class="treeview-item" href="{{route('student.feeDetails') }}"><i class="icon fa fa-angle-right"></i> Student Fee Details</a></li>
              <li><a class="treeview-item" href="{{route('feemanagementreport.index') }}"><i class="icon fa fa-angle-right"></i>Monthly Section Wise Report</a></li>
              <li><a class="treeview-item" href="{{route('payment.index') }}"><i class="icon fa fa-angle-right"></i>Check Payment</a></li>

            </ul>
          </li>
          @endcan

          @can('Mark')
          <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><span class="app-menu__label">Mark Entry</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
              <li><a class="treeview-item" href="{{route('marks.index') }}"><i class="icon fa fa-angle-right"></i> Marks Entry</a></li>
            </ul>
          </li>
          @endcan

          {{--  result published  --}}
          @can('Result')
          <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><span class="app-menu__label">Result</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
              <li><a class="treeview-item" href="{{route('resultPublished.index') }}"><i class="icon fa fa-angle-right"></i>Result Publish </a></li>
              <li><a class="treeview-item" href="{{route('result.index') }}"><i class="icon fa fa-angle-right"></i>individual Result </a></li>
            </ul>
          </li>
          @endcan
          
           <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><span class="app-menu__label">Home Work </span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
              <li><a class="treeview-item" href="{{route('homework.index') }}"><i class="icon fa fa-angle-right"></i>Home work</a></li>
            </ul>
          </li>

         {{--  @can('Scholarship')
          <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><span class="app-menu__label">Scholarship Management</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
              <li><a class="treeview-item" href="{{route('scholarship.management')}}"><i class="icon fa fa-angle-right"></i>Schoolarship</a></li>
            </ul>
          </li>
          @endcan --}}

        @can('Book')
          <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><span class="app-menu__label">Book</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
              <li><a class="treeview-item" href="{{url('file/store')}}"><i class="icon fa fa-angle-right"></i>File Document</a></li>
            </ul>
          </li>
          @endcan

           @can('Notification')
          <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><span class="app-menu__label">Notification</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="{{url('notification/emailSms')}}"><i class="icon fa fa-angle-right"></i>Send Email / SMS</a></li>
                {{-- <li><a class="treeview-item" href="{{url('notification/notificationBoard')}}"><i class="icon fa fa-angle-right"></i>Notice Board</a></li>
                <li><a class="treeview-item" href="{{url('notification/index')}}"><i class="icon fa fa-angle-right"></i>Send Message</a></li>
                <li><a class="treeview-item" href="{{url('notification/emailSmsLog')}}"><i class="icon fa fa-angle-right"></i>Email / SMS Log</a></li> --}}
            </ul>
          </li>
          @endcan

          @can('Grade Management')
          <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><span class="app-menu__label">Grade Management</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
              <li><a class="treeview-item" href="{{route('grade.index') }}"><i class="icon fa fa-angle-right"></i> Grade list</a></li>
            </ul>
          </li>
          @endcan
            
          @can('Student Promotion')  
           <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><span class="app-menu__label">Promotion</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
              <li><a class="treeview-item" href="{{route('promotion.index') }}"><i class="icon fa fa-angle-right"></i>Sectionwise Promotion</a></li>
            </ul>
          </li>
          @endcan

          @can('Exam')
          <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><span class="app-menu__label">Exam Management</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
              <li><a class="treeview-item" href="{{route('exam.index') }}"><i class="icon fa fa-angle-right"></i> Exam list</a></li>
              {{-- <li><a class="treeview-item" href="{{route('exam.index') }}"><i class="icon fa fa-angle-right"></i> Exam Slot</a></li>
              <li><a class="treeview-item" href=""><i class="icon fa fa-angle-right"></i> Exam Schedule</a></li> --}}
              <li><a class="treeview-item" href="{{route('examattendance.index') }}"><i class="icon fa fa-angle-right"></i> Exam Attendance</a></li>
            </ul>
          </li>
          @endcan
          @can('report')
          <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><span class="app-menu__label">Report Management</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
              <li><a class="treeview-item" href="{{route('classBased.income.Report') }}"><i class="icon fa fa-angle-right"></i>Class Based Income Report</a></li>
            <li><a class="treeview-item" href="{{route('dateWise.income.expanse')}}"><i class="icon fa fa-angle-right"></i>Income & Expense Report</a></li>
            <li><a class="treeview-item" href="{{route('grade.result.report')}}"><i class="icon fa fa-angle-right"></i>Grade Based Report</a></li>
            <li><a class="treeview-item" href="{{route('section.attendence.report')}}"><i class="icon fa fa-angle-right"></i>Section Based Attendence Report</a></li>
            </ul>
          </li>
          @endcan
          @can('Admit Card')

          <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="fa fa-spinner fa-spin fa-fw"></i><span class="app-menu__label">Admit Card</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
              <li><a class="treeview-item" href="{{route('student.admit.card') }}"><i class="icon fa fa-angle-right"></i>Sectionwise Admit Card </a></li>
            </ul>
            <ul class="treeview-menu">
              <li><a class="treeview-item" href="{{route('individual.admit.card') }}"><i class="icon fa fa-angle-right"></i>Individual Admit Card </a></li>
            </ul>
          </li>
          @endcan
          @can('Seat Plan')
          <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="fa fa-spinner fa-spin fa-fw"></i><span class="app-menu__label">Seat Plan</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
              <li><a class="treeview-item" href="{{route('seat.plan') }}"><i class="icon fa fa-angle-right"></i>Seat Plan </a></li>
            </ul>
          </li>
          @endcan
          {{-- end admin sidebar --}}

          {{-- student side bar --}}
            @else

          @endif
      </ul>
    </aside>
