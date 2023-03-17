@extends('backend.layouts.master')
	@section('title', 'Attendance')
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
          <h3 class="tile-title border-bottom p-2">Student Search</h3>
          <div class="tile-body">
            <form class="row">
            <div class="form-group col-md-3">
                <label for="exampleFormControlSelect1">Session Year</label>
                <select class="form-control admission" id="sessionYear">
                  <option value="">select</option>
                  @foreach ($sessionYear as $year)
                    <option value="{{$year->id}}">{{$year->sessionYear}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group col-md-3">
              <label class="control-label mt-3">Shift</label><br>
                <div class="custom-control shift-radio custom-control-inline">
                    <input type="radio" name="shift" id="shift1" value="Morning" class="custom-control-input admission">
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

              <!-- single section-->
              <div class="form-group col-md-3">
                <label for="exampleFormControlSelect1">Select Class</label>
                <select class="form-control admission" id="classId">
                  <option value="">select Class </option>
                  @foreach ($class as $class)
                  <option value="{{$class->id}}">{{$class->className}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group col-md-3">
                <label for="exampleFormControlSelect1"> Section</label>
                <select class="form-control" id="sectionId">
                <option value=""> --Please Section--  </option>
                </select>
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
    <div class="row justify-content-md-center">
        <div class="col-md-10">
            <div class="tile">
                <div class="tile-body">
                    <form action="{{route('store.attendence')}}" method="post" id="attendence">
                        @csrf
                       <input type="text" name="sectionId" id="sectionId2" hidden>
                        <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                            <tr>
                                <th>Attendence</th>
                                <th>Student Roll</th>
                                <th>Student Name</th>
                                
                            </tr>
                            </thead>
                            <tbody>
                       
                           
                            </tbody>
                        </table>
                        </div>
                        <button class="btn btn-lg btn-primary " type="submit"><i class="fa fa-plus-square" aria-hidden="true"></i>attendence</button>
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
     dynamicSectionSelection();
    </script>
    <script>
      $('#sectionId').change(function (e) {
        e.preventDefault();
       
        var sectionId= $("#sectionId").val();
        $("#sectionId2").attr('value',sectionId);

        $.ajax({
          type: "post",
          url: "{{ url('/student/attendance/studentData')}}",
          data: {
            sectionId:sectionId
          },
          
          success: function (response) {
          console.log(response.redirectToEdit);
          if(response.redirectToEdit){
            window.location.href = response.redirectToEdit;
          }else{
          
          var tr='';
            $.each (response, function (key, value) {
            tr +=
            "<tr>"+
                "<td>"+
                '<label class="radio"><input class="" type="radio" name="attend['+value.id+']" value="present">present</label><label class="radio"><input class="" type="radio" name="attend['+value.id+']" value="absent">Absent</label><label class="radio"><input class="" type="radio" name="attend['+value.id+']" value="late">late</label>'
                +"</td>"+
                "<td>"+value.roll+"</td>"+
                "<td>"+value.firstName+"</td>"+
                
           "</tr>";
          
   });

            $('tbody').html(tr);
          }
        }
        });
      
        })
    </script>

@endsection
