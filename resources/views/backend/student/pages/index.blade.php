
  @extends('backend.student.layouts.master')
	@section('title','student deshbord')
    @section('content')
    <style>
    .card {
    overflow:hidden;
}

.card-body .rotate {
    z-index: 8;
    float: right;
    height: 100%;
}

.card-body .rotate i {
    color: rgba(20, 20, 20, 0.15);
    position: absolute;
    left: 0;
    left: auto;
    right: -10px;
    bottom: 0;
    display: block;
    -webkit-transform: rotate(-44deg);
    -moz-transform: rotate(-44deg);
    -o-transform: rotate(-44deg);
    -ms-transform: rotate(-44deg);
    transform: rotate(-44deg);
}

</style>
    <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> Student Dashboard</h1>
          <p>Role: Not Assign</p>
          <p id="name" hidden> asasd</p>
          <h1 id="schoolname" hidden > school</h1>
          <h1 id="mobile" hidden > school</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        </ul>
    </div>
      <!-- Will be applied progress bar -->
      <!--<div class="row">-->
      <!--    <div class="col-md-12">-->
      <!--      <div class="tile">-->
      <!--      <div class="progress-bar" role="progressbar" style="width: 50%;" >25% Profile Progress</div>-->
      <!--      </div>-->
      <!--    </div>-->
      <!--</div>-->
      <div class="row mb-5">
        <div class="col-xl-3 col-sm-6 py-2 mb-2">
            <div class="card text-white bg-info h-100">
                <div class="card-body bg-info">
                    <div class="rotate">
                        <i class="fa fa-twitter fa-4x"></i>
                    </div>
                    <h6 class="text-uppercase">My Attendance percentage</h6>
                    <p class="display-4" id="Attendance"> </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 py-2 mb-2">
            <div class="card text-white bg-warning h-100">
                <div class="card-body bg-warning">
                    <div class="rotate">
                        <i class="fa fa-twitter fa-4x"></i>
                    </div>
                    <h6 class="text-uppercase">My Absent percentage</h6>
                    <p class="display-4" id="AttendanceAbsent"> </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 py-2 mb-2">
            <div class="card text-white bg-warning h-100">
                <div class="card-body">
                    <div class="rotate">
                        <i class="fa fa-share fa-4x"></i>
                    </div>
                    <h6 class="text-uppercase">Total Class Mates</h6>
                    <h1 class="display-4" id="totalstudent"></h1>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 py-2 mb-2">
            <div class="card text-white bg-success h-100">
                <div class="card-body">
                    <div class="rotate">
                        <i class="fa fa-share fa-4x"></i>
                    </div>
                    <h6 class="text-uppercase">Total Present This month</h6>
                    <h1 class="display-4" id="present"></h1>DAY
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 py-2 mb-2">
            <div class="card text-white bg-danger h-100">
                <div class="card-body">
                    <div class="rotate">
                        <i class="fa fa-share fa-4x"></i>
                    </div>
                    <h6 class="text-uppercase">Total Absent This month</h6>
                    <h1 class="display-4" id="absent"></h1>DAY
                </div>
            </div>
        </div>
     </div>
        <div class="row">
            <div class="col-md-5">
                  <div class="tile">
                      <h3 class="tile-title">My Attendance Information <?php echo date('M Y'); ?> in Pie Chart</h3>
                      <div class="embed-responsive embed-responsive-16by9">
                          <canvas class="embed-responsive-item" id="pieChartDemo"></canvas>
                      </div>
                  </div>
              </div>
              <div class="col-md-7">
                <div class="tile">
                    <div class="tile-body">
                        <h3 class=" row justify-content-md-center">My Attendance Information of: <?php echo date('M Y'); ?> </h3>
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered" id="sampleTable">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Date</th>
                                        <th>StudentId</th>
                                        <th>attendance</th>
                                        <th>Last Attendance</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 col-sm-4">
                <div class="tile">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Class Routins</h5>
                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                            <a href="#" class="btn btn-primary" onclick=" subject()">Download</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="tile">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Syllabus  </h5>
                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                            <a href="#" class="btn btn-primary" onclick=" subject()">Download</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
            <div class="tile">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Book List  </h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        <a href="#" class="btn btn-primary" onclick=" subject()">Download</a>
                    </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="tile">
                    <div class="tile-body">
                        <div class="page-header">
                        <h2 class="mb-3 line-head" id="indicators">Notifications</h2>
                        </div>
                        <div class="bs-component">
                        <div class="alert alert-dismissible alert-success">
                            <button class="close" type="button" data-dismiss="alert">×</button><strong>Well done!</strong> You successfully read <a class="alert-link" href="#">this important alert message</a>.
                        </div>
                        </div>
                        <div class="bs-component">
                        <div class="alert alert-dismissible alert-success">
                            <button class="close" type="button" data-dismiss="alert">×</button><strong>Well done!</strong> You successfully read <a class="alert-link" href="#">this important alert message</a>.
                        </div>
                        </div>
                        <div class="bs-component">
                        <div class="alert alert-dismissible alert-info">
                            <button class="close" type="button" data-dismiss="alert">×</button><strong>Heads up!</strong> This <a class="alert-link" href="#">alert needs your attention</a>, but it's not super important.
                        </div>
                        </div>
                        <div class="bs-component">
                        <div class="alert alert-dismissible alert-info">
                            <button class="close" type="button" data-dismiss="alert">×</button><strong>Heads up!</strong> This <a class="alert-link" href="#">alert needs your attention</a>, but it's not super important.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="tile">
                <div class="card">
                        <div class="page-header">
                                <h2 class="mb-3 line-head" id="indicators">Event Information</h2>
                                </div>
                    <div class="card-body">
                        <h5 class="card-title">Event Name</h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        <a href="#" class="btn btn-primary" onclick=" subject()">Read More</a>
                    </div>
                    <div class="card-body">
                            <h5 class="card-title">Event Name</h5>
                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                            <a href="#" class="btn btn-primary" onclick=" subject()">Read More</a>
                        </div>
                </div>
            </div>
        </div>
      @endsection
      @section('script')
      @include('backend.student.partials.js.datatable');

      <script src="{{ asset('admin/js/plugins/chart.js') }} "> </script>
       <script type="text/javascript">

      $(document).ready(function () {


      var d = new Date();
      var month=d.getMonth()+1;
      var studentId= {{Auth::guard('student')->user()->id}};
      //console.log(studentId);
            //document.getElementById("date").innerHTML = month;
           //   $('table').attr('id',month);

    $.ajax({
        type: "get",
        url: "{{route('api.present')}}",
        data: {
            month :month,
            studentId:studentId,
        },
        success: function (data) {
         //var data1 =parseFloat(data.data).toFixed(2);
        $('#present').html(data.data);


           // document.getElementById("attendance").innerHTML= parseFloat(data).toFixed(2);
        }
    });
    $.ajax({
        type: "get",
        url: "{{route('api.absent')}}",
        data: {
            month :month,
            studentId:studentId,
        },
        success: function (data) {
         //var data1 =parseFloat(data.data).toFixed(2);
         $('#absent').html(data.data);

        }
    });
    $.ajax({
        type: "get",
        url: "{{url('/api/search/studentname')}}",
        data: "data",
            success:function(data) {

                var firstname = data[0].firstName;
                var lastname = data[0].lastName;
                var mobile = data[0].mobile;

                var fullname= firstname+' '+lastname;

                var schoolname= data[0].school_branch.nameOfTheInstitution;
               document.title = schoolname;
                $('#name').html(fullname);
                $('#schoolname').html(schoolname);
                $('#mobile').html(mobile);



                }

    });


      var table=$('#sampleTable').DataTable({
            dom: 'lBfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf',

                {
                    extend: 'print',
                    messageTop: function () {
                        return '<div class="text-center">' +'<h1>'+$('#schoolname').text()+'</h1>'+' '
                            +'<br/> '+' Student Name: '+$('#name').text() +' '+'. Contact Number: '+$('#mobile').text()+' '
                            +'<br/>'+'Total present this Month : '+' '+'<strong>'+ $('#present').text()+'</strong>'+' '+' Day. '
                            +' Absent This month: '+'<strong>'+ $('#absent').text()+'</strong>'+' Day. '+'</div>' ;
                    }

                }
            ],
             processing:true,
             serverSide:true,
             ajax:"{{url('/student/attendance/show/')}}"+"/"+month,
             columns:[
                 { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                 { data: 'created_at1', name: 'created_at1' },
                 { data: 'studentId', name: 'studentId' },
                 { data: 'attendence', name: 'attendence' },
                 { data: 'created_at', name: 'created_at' },
             ]
         });


        $.ajax({
            type: "get",
            url: "{{url('/student/attendance/attendancePercentage/')}}"+"/"+month,
            data: "data",

            success: function (response) {
                console.log(response);
                document.getElementById("Attendance").innerHTML= parseFloat(response).toFixed(2);
                var absent=100- response;
                console.log(absent);
                document.getElementById("AttendanceAbsent").innerHTML= parseFloat(absent).toFixed(2);
                var pdata = [{
                  value: response,
                  color: "#46BFBD",
                  highlight: "#5AD3D1",
                  label: "Persent"
              },
              {
                  value: absent,
                  color: "#F7464A",
                  highlight: "#FF5A5E",
                  label: "Absent"
              }

          ]
          var ctxp = $("#pieChartDemo").get(0).getContext("2d");
          var pieChart = new Chart(ctxp).Pie(pdata);

            }
        });

        $.ajax({
            type: "GET",
            url: "{{url('/student/totalstudent')}}",
            data: "data",
            success: function (data) {
               $('#totalstudent').html(data.data);
            }
        });

  });

  function subject(){
    alert('File is not Included');
}


  </script>
      @endsection

<!-- Essential javascripts for application to work-->
