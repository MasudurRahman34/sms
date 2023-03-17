@extends('backend.layouts.master')
	@section('title', 'Date Wish Attendance')
    @section('content')
    {{-- //main content --}}
    <div class="app-title">
        <div>
            <h1><i class="fa fa-plus-square" aria-hidden="true">&nbsp;</i>Student Attendence</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">Tables</li>
            <li class="breadcrumb-item active"><a href="#">Student Attendence</a></li>
        </ul>
    </div>
    @include('backend.partials._message')

    <!--Start Row-->
    <div class="row justify-content-md-center"><!-- justify-content-md-center-->
      <!--Start inline section-->
      <div class="clearix"></div>
      <div class="col-md-10">
        <div class="tile">
        <button type="button" class="btn-info float-right" onClick="reloadThePage()">Refresh!</button>
          <h3 class="tile-title border-bottom p-2">Student Search </h3>
          <div class="tile-body">
            <form class="row" id="myform" action="javascript:void(0)">
              <div class="form-group col-md-3">
                <label for="exampleFormControlSelect1">Date</label>
                <div class="">
                  <input class="form-control admission" type="date" name="dateId" id="dateId" >
                </div>
              </div>
              <!-- <div class="form-group col-md-12">
              <button class="btn btn-lg btn-primary edit_studClass" type="submit" style="float: right;" id="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Submit</button>
              </div> -->
            </form>
          </div>
        </div>
      </div>
      <!--End inline section -->
    </div>

    <!--End Row-->
    <div class="row justify-content-md-center" >
        <div class="col-md-10" >
            <div class="tile" >
                <div class="tile-body" id="tblHidden" hidden>
                    <form action="{{route('myclass.store')}}" method="post" id="attendence">
                        @csrf
                       <input type="text" name="sectionId" id="sectionId2" value="{{$sectionId}}" hidden>
                       <input type="date" name="created_date" id="dateId2" hidden>
                       <input type="text" name="classId2" id="classId2"  value="{{$classId}}" hidden>
                        <div class="table-responsive" >
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                            <tr>
                                <th>Student Roll</th>
                                <th>Attendence</th>

                                <th>Student Name</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        </div>
                        <button class="btn btn-primary " type="submit" id="btnAttendance" disabled="true"<i class="fa fa-plus-square" aria-hidden="true"></i>Attendance</button>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>
    <!--End Row-->

    <div class="clearix"></div>
@endsection
@section('script')

    <script>

      $('#dateId').change(function (e) {
        e.preventDefault();
        // alert('working');

        var sectionId= {{$sectionId}};
        var dateId= $("#dateId").val();
        var classId= {{$classId}};
        $("#sectionId2").attr('value',sectionId);
        $("#dateId2").attr('value',dateId);
        $("#classId2").attr('value',classId);
        // var date=$("#dateId2").val();
        console.log(sectionId, classId2, dateId2);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
            });

        $.ajax({
          type: "post",
          url: "{{ url('/student/attendance/studentDatabydate')}}",
          data: {
            sectionId:sectionId,
            dateId:dateId,
          },
          success: function (response) {
          console.log(response);
          if(response.redirectToEdit){
            var txt;
              if (confirm("Attendance has been Taken At This Date, Do You Need update ?")) {
                window.location.href = response.redirectToEdit;
              } else {
                document.getElementById("myform").reset();
              }
          }else{

            $('#tblHidden').attr('hidden',false);
            $('#btnAttendance').attr('disabled',false);

          var tr='';
            $.each (response, function (key, value) {
            tr +=
            "<tr>"+
                "<td>"+value.roll+"</td>"+
                "<td>"+
                  '<label class="radio"><input class="roll['+value.roll+']" type="radio" name="attend['+value.id+']" value="present">Present</label>'+
                  '<label class="radio"><input class="roll['+value.roll+']" type="radio"  name="attend['+value.id+']" value="absent">Absent</label>'+
                  '<label class="radio"><input class="roll['+value.roll+']" type="radio" name="attend['+value.id+']" value="late">late</label>'+
                "</td>"+
                "<td>"+value.firstName+"</td>"+
           "</tr>";
          });

            $('tbody').html(tr);
          }
        }
        });

        })
        $(document).ready(function () {
          $("form").submit(function () {

            var roll=true;
            $(":radio").each(function () {
              name=$(this).attr('class');

              if(roll && !$(':radio[class="'+name+'"]:checked').length){
                alert(' missing  '+ name);
                console.log(name);
                roll=false;
              }

            });
            return roll;

          });
        });

        //massing student
    </script>

@endsection
