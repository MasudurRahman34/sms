@extends('backend.layouts.master')
	@section('title', 'Student Admit Card Generate')
    @section('content')
    <div class="app-title">
        <div>
          <h1><i class="fa fa-edit"></i>Section Wish Student's Admit Card Generate</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Home</li>
          <li class="breadcrumb-item"><a href="#">Student's Admit Card Generate</a></li>
        </ul>
    </div>
<div class="row justify-content-md-center">
    <div class="clearix"></div>
        <div class="col-md-10">
            <div class="tile">
                <div class="tile-body">
                    <div class="row">
                        @if (Auth::user()->hasPermissionTo('Admit Card'))
                            
                        
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
                            <label for="exampleFormControlSelect1"> Section</label>
                            <select class="form-control" id="sectionId">
                                <option value=""> --Please Select--  </option>
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
                        
                        @elseif(Auth::user()->hasAllPermissions('Admit Card', 'Class Teacher'))
                            Test
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
                        @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="clearix"></div>
<div id="admits">
</div>

<div class="clearix"></div>    
    @endsection
    @section('script')
      @include('backend.partials.js.datatable');
      <script>
    dynamicSectionSelection();

    $('#exam').change(function (e) {
        e.preventDefault();

        var classId=$("#classId").val();
        var sectionId=$("#sectionId").val();
        var examName=$("#exam").val();
        var url = "{{url('student/admitCardSectionWiseList/')}}"+'/'+classId+'/'+sectionId+'/'+examName;

        $.get(url).done(function(data){
            console.log(data);
            $("#admits").html(data);
        });
        console.log(classId, sectionId);

        
    });
    //table.destroy();

    




    </script>

    @endsection
