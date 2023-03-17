<aside class="app-sidebar">
      <div class="app-sidebar__user">
      @foreach(App\model\File::where('studentId', Auth::guard('student')->user()->id)->get() as $fill)
        @if(!empty($fill))
              <img class="app-sidebar__user-avatar" src="{{asset('students/'.$fill->image)}}" style="width: 25%; height: 25%;">
            @else
              <img class="app-sidebar__user-avatar" src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg" alt="User Image">
            @endif
     @endforeach
        <div>
          <span class="text-info">Welcome,</span>
          <p style="font-size:16px;" class="app-sidebar__user-name">{{Auth::guard('student')->user()->firstName}}</p>
          <p style="font-size:16px;" class="app-sidebar__user-designation">{{Auth::guard('student')->user()->lastName}}</p>
        </div>
      </div>
      <ul class="app-menu">
            <li><a class="app-menu__item {{ Request::is('student.index*') ? 'active' : '' }}" href="{{url('/student/index ')}}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
            <li><a class="app-menu__item" href="{{route('school.corner')}}"><i class="fa fa-graduation-cap" aria-hidden="true"></i>&nbsp; <span class="app-menu__label">School Corner</span></a></li>

        <li class="treeview"><a class="app-menu__item " href="#" data-toggle="treeview"><i class="fa fa-cog fa-spin fa-fw"></i>&nbsp;<span class="app-menu__label text-warning">Settings</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="#"><i class="icon fa fa-angle-right"></i>Privacy</a></li>
                <li><a class="treeview-item" href="{{route('student.show')}}"><i class="icon fa fa-angle-right"></i>Profile</a></li>
            </ul>
          </li>
          <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">Attendence</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
              <li><a class="treeview-item" href="{{ route('attendence.index') }}"><i class="icon fa fa-angle-right"></i>Monthly Attendance</a></li>
            </ul>
          </li>

          <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"> <i class="fas fa-spinner fa-pulse"></i><span class="app-menu__label">My Class</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">

              <li><a class="treeview-item" href="{{route('student.classmates')}}"><i class="icon fa fa-angle-right"></i>ClassMates</a></li>
            </ul>
          </li>
          <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">My Subject</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">

              <li><a class="treeview-item" href="{{route('student.subjectlist') }}"><i class="icon fa fa-angle-right"></i>Subject List</a></li>
            </ul>
          </li>
          <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;<span class="app-menu__label">Teacher</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
              <li><a class="treeview-item" href="{{route('student.teacherList') }}"><i class="icon fa fa-angle-right"></i>Teacher List</a></li>

            </ul>
          </li>
          <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="fa fa-spinner fa-spin fa-fw"></i><span class="app-menu__label">Fee Details</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
              <li><a class="treeview-item" href="{{route('student.fee.index')}}"><i class="icon fa fa-angle-right"></i>Monthly Paid Fees</a></li>
              <li><a class="treeview-item" href="{{route('student.due.fee')}}"><i class="icon fa fa-angle-right"></i>Due Fees</a></li>
            </ul>
          </li>
          <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;<span class="app-menu__label">home work</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
              <li><a class="treeview-item" href="{{route('student.homeworklist') }}"><i class="icon fa fa-angle-right"></i>home work List</a></li>

            </ul>
          </li>
          <!-- <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">Exam</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
              <li><a class="treeview-item" href="{{route('section.index') }}"><i class="icon fa fa-angle-right"></i>Student</a></li>
              <li><a class="treeview-item" href="#"><i class="icon fa fa-angle-right"></i>Exam Routine Download</a></li>
            </ul>
          </li>
          <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">Class Routine</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
              <li><a class="treeview-item" href="{{route('section.index') }}"><i class="icon fa fa-angle-right"></i>Teacher</a></li>
              <li><a class="treeview-item" href="#"><i class="icon fa fa-angle-right"></i>Student</a></li>
            </ul>
          </li> -->

        <!-- <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">Expence</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
              <li><a class="treeview-item" href="{{route('section.index') }}"><i class="icon fa fa-angle-right"></i>Section</a></li>
            </ul>
          </li> -->

          <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;<span class="app-menu__label">Result</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
              <li><a class="treeview-item" href="{{route('student.result.index') }}"><i class="icon fa fa-angle-right"></i>My Result</a></li>
            </ul>
          </li>
      </ul>
    </aside>
