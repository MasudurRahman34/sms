
  @extends('backend.layouts.master')
	@section('title', 'Admin Deshboard')
    @section('content')
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
        <p>Role: {{Auth::user()->getRoleNames()}}</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        </ul>
      </div>
      <div class="row">
        @can('Super Admin')
        <div class="col-md-6 col-lg-3">
            <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
                <div class="info">
                <h4 class="font-weight-bold">School And Branch</h4>
                <p class="float-right"> Total <b>5</b></p>
                </div>
            </div>
        </div>
        @endcan

            <div class="col-md-6 col-lg-3">
                <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
                    <div class="info">
                    <h4 class="font-weight-bold">Total Student</h4>
                    <h4 class="float-right"  > <b id="totalstudent"></b></h4>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                    <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
                        <div class="info">
                        <h4 class="font-weight-bold">Overall Attendance Percentage</h4>
                        <p class="float-right"> Present <b  id="attendance"></b></p>
                        </div>
                    </div>
            </div>


            <div class="col-md-6 col-lg-3">
                    <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
                        <div class="info">
                        <h4 class="font-weight-bold">Total Teacher</h4>
                        <p class="float-right"> Total <b id="totalteacher"></b></p>
                        </div>
                    </div>
            </div>
            <div class="col-md-6 col-lg-3">
                    <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
                        <div class="info">
                        <h4 class="font-weight-bold">Total School Employee</h4>
                        <p class="float-right">  <b id="totaluser"></b></p>
                        </div>
                    </div>
            </div>
            <div class="col-md-6 col-lg-3">
                    <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
                        <div class="info">
                        <h4 class="font-weight-bold">Total Section</h4>
                        <p class="float-right">  <b id="totalsection"></b></p>
                        </div>
                    </div>
            </div>
            <!-- <div class="col-md-6">
              <div class="tile">
                <h3 class="tile-title">Bar Chart</h3>
                <div class="embed-responsive embed-responsive-16by9">
                  <canvas class="embed-responsive-item" id="barChartDemo"></canvas>
                </div>
              </div> -->

          </div>
          <div class="row">
            <div class="col-md-5">
                <div class="tile">
                    <h3 class="tile-title"> Today: Attendance Report </h3><hr>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                                <tr>
                                    {{-- <th>#</th> --}}
                                    <!-- <th> Class Name</th> -->
                                    <th> Class </th>
                                    <th> Section </th>
                                    <th> Shift</th>
                                    <th>Number of Present Student </th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                </div>
                <div class="col-md-7">
                    <div class="tile">
                        <h4 class="tile-title"> Datewise: Student Attendance Report </h4><hr>
                        <div class="tile-body">
                            <div class="row">
                                <div class="form-group col-xs-2 pl-2">
                                    <label class="control-label mt-3">Shift</label><br>
                                    <div class="custom-control shift-radio custom-control-inline">
                                    <input type="radio" name="shift" id="shift1" value="Morning" class="custom-control-input admission" checked>
                                    <label class="custom-control-label"  for="shift1">Morning</label>
                                    </div>
                                    <div class="custom-control shift-radio custom-control-inline">
                                    <input type="radio" name="shift" id="shift2" value="Day" class="custom-control-input admission">
                                    <label class="custom-control-label" for="shift2">Day</label>
                                    </div>
                                    <div class="custom-control shift-radio custom-control-inline">
                                    <input type="radio" name="shift" id="shift3" value="Evening" class="custom-control-input admission">
                                    <label class="custom-control-label" for="shift3">Evening</label>
                                    </div>
                                </div>
                                <div class="form-group col-xs-2 pr-2">
                                    <label for="exampleFormControlSelect1">Select Class</label>
                                    <select class="form-control admission" id="classId" name="classId">
                                    <option value="">--Please Select--</option>
                                    @foreach ($class as $class)
                                    <option value="{{$class->id}}">{{$class->className}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-xs-2 pr-2">
                                    <label for="exampleFormControlSelect1"> Section</label>
                                    <select class="form-control " id="sectionId">
                                    <option value=""> --Please Select--  </option>
                                    </select>
                                </div>
                                <div class="form-group col-xs-2">
                                        <label for="exampleFormControlSelect1">Date</label>
                                        <div class="">
                                          <input class="form-control " type="date" name="dateId" id="dateId" value="{{date('Y-m-d')}}" >
                                        </div>
                                      </div>
                                <div class="form-group col-md-6" hidden>
                                    <select class="form-control " id="sessionYear" >
                                    <option value="">--Please Select--</option>
                                    @foreach ($sessionYear as $year)
                                    <option value="{{$year->id}}" {{$year->status == 1 ? 'selected': ''}}>{{$year->sessionYear}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="tile">
                    <h3 class="tile-title"> Attendance Report</h3>
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered" id="sampleTable1">
                                <thead>

                                    <tr>
                                        <th></th>
                                        <th>Date</th>
                                        <th>Attendace</th>
                                        <th>roll</th>
                                        <th>Name</th>

                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

      @endsection
      @section('script')
       @include('backend.student.partials.js.datatable');
       <script type="text/javascript" src="{{ asset('admin/js/plugins/bootstrap-datepicker.min.js') }}"></script>
      <script type="text/javascript" >

       $(document).ready(function () {

       var d = new Date();
       var todate=d.getDate();
       var month=d.getMonth()+1;




       //overall current monthly attendence for all student

         $.ajax({
             type: "get",
             url: "{{url('/api/search/StudentAttendancePercentage')}}"+"/"+month,
             data: "data",
             success: function (data) {
              var data1 =parseFloat(data.data).toFixed(2);
              $('#attendance').html(data1);
          //        console.log(response);
                // document.getElementById("attendance").innerHTML= parseFloat(data).toFixed(2);
             }
         });

         // total student of a  school

         $.ajax({
             type: "GET",
             url: "{{url('/api/search/totalstudent')}}",
             data: "data",
             success: function (data) {
                $('#totalstudent').html(data.data);
             }
         });

         //total teacher of this school
         $.ajax({
             type: "GET",
             url: "{{url('/api/search/totalTeacher')}}",
             data: "data",
             success: function (data) {
                $('#totalteacher').html(data.data);
             }
         });

         //total user of this school
         $.ajax({
             type: "GET",
             url: "{{url('/api/search/totalUser')}}",
             data: "data",
             success: function (data) {
                $('#totaluser').html(data.data);
             }
         });

         //total section created by school
         $.ajax({
             type: "GET",
             url: "{{url('/api/search/totalsection')}}",
             data: "data",
             success: function (data) {
                $('#totalsection').html(data.data);
             }
         });


         var table=$('#sampleTable').DataTable({
            dom: 'lBfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf','print'

            ],

             processing:true,
             serverSide:true,
             ajax:"{{url('/api/search/classwishAttentage')}}",
             columns:[
                //  { data: 'hash', name: 'hash' },
                //  { data: 'ClassName', name: 'ClassName' },
                 { data: 'className', name: 'className' },
                 { data: 'sectionName', name: 'sectionName' },
                 { data: 'shift', name: 'shift' },
                 { data: 'present', name: 'present' },
             ]
         });

    //find section for attendance information
     dynamicSectionSelection();

        //on change date
        //$('#dateId').change(function (e) {

       //$('#dateId').keyup(function (e) {    
        $('#dateId').mouseout(function (e) {    
            e.preventDefault();

            var classId=$("#classId").val();
            var sectionId=$("#sectionId").val();
            var dateId=$("#dateId").val();
            var d = new Date();
            var month=d.getMonth()+1;

            console.log(classId,sectionId, dateId);

            var table= $('#sampleTable1').DataTable({
                dom: 'lBfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf','print'

                ],

                processing:true,
                serverSide:true,
                pagin:true,
                destroy:true,
                ajax:"{{url('api/search/sectionAttendance/')}}"+'/'+classId+'/'+sectionId+'/'+dateId,
                columns:[
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'attendence', name: 'attendence' },

                    { data: 'student.roll', name: 'student.roll' },
                    { data: 'student.firstName', name: 'student.firstName' },

                ],

            });


        });


   });
   </script>
   @endsection
