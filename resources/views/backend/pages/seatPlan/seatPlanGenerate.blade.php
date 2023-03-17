@extends('backend.layouts.master')
	@section('title', 'Student Seat Plan Generate')
    @section('content')
    <div class="app-title">
        <div>
          <h1><i class="fa fa-edit"></i>Student Exam Seat Plan Generate</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Home</li>
          <li class="breadcrumb-item"><a href="#">Student Exam Seat Plan</a></li>
        </ul>
    </div>
<div class="row justify-content-md-center">
    <div class="clearix"></div>
        <div class="col-md-9">
        <form id="myform" action="javascript:void(0)">
            <div class="tile">
                <div class="tile-body">
                    <div class="row">
                        @if (Auth::user()->hasPermissionTo('Seat Plan'))
                    <div class="form-group col-md-4">
                        <label for="exampleFormControlSelect1"> Session Year</label>
                            <select class="form-control admission" id="sessionYear" >
                                <option value="">--Please Select--</option>
                                @foreach ($sessionYear as $year)
                                    <option value="{{$year->id}}" {{$year->status == 1 ? 'selected': ''}}>{{$year->sessionYear}}</option>
                                @endforeach
                            </select>
                    </div>
                    <div class="form-group col-md-4">
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
                    <div class="form-group col-md-4">
                        <label for="exampleFormControlSelect1">Select Class</label>
                        <select class="form-control admission" id="classId" name="classId">
                            <option value="">--Please Select--</option>
                            @foreach ($class as $class)
                            <option value="{{$class->id}}">{{$class->className}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="exampleFormControlSelect1"> Exam</label>
                        <select class="form-control admission" id="exam" >
                            <option value="">--Please Select--</option>
                            @foreach ($exam as $exam)
                                <option value="{{$exam->examName}}" >{{$exam->examName}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="exampleFormControlSelect1"> Section</label>
                        <select class="form-control" id="sectionId">
                            <option value=""> --Please Select--  </option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="exampleFormControlSelect1"> Room Number</label>
                        <input class="form-control col-md-10" type="text" id="roomNumber" value="" name="roomNumber">
                </div>
                    @elseif (Auth::user()->hasAllPermissions('Class Teacher'))
                    <div class="form-group col-md-4">
                        <label for="exampleFormControlSelect1"> Exam</label>
                        <select class="form-control admission" id="exam" >
                            <option value="">--Please Select--</option>
                            @foreach ($exam as $exam)
                                <option value="{{$exam->examName}}" >{{$exam->examName}}</option>
                            @endforeach
                        </select>
                    </div>
                        
                    <div class="form-group col-md-4">
                            <label for="exampleFormControlSelect1"> Room Number</label>
                            <input class="form-control col-md-10" type="text" id="roomNumber" value="" name="roomNumber">
                    </div>
                    @endif
                    </div>
                    <div class="tile-footer">
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-primary" id="submitSeatPlan" type="button"  style="float: right;"><i class="fa fa-fw fa-lg fa-check-circle"></i>Submit</button>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </form>
        </div>

    </div>
<div class="clearix"></div>
<div id="seatPlans">
</div>

<div class="clearix"></div>    
    @endsection
    @section('script')
      @include('backend.partials.js.datatable');
      <script>
    dynamicSectionSelection();

    $('#submitSeatPlan').click(function (e) {
        e.preventDefault();

        var classId=$("#classId").val();
        var sectionId=$("#sectionId").val();
        var examName=$("#exam").val();
        var room =$("#roomNumber").val();

        var url = "{{url('student/seatPlanPrint/')}}"+'/'+classId+'/'+sectionId+'/'+examName+'/'+room;

        $.get(url).done(function(data){
            console.log(data);
            $("#seatPlans").html(data);
        });
        console.log(classId, sectionId);

        
    });
    //table.destroy();
    </script>

    @endsection
