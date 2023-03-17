@extends('backend.layouts.master')
	@section('title', 'Admin|| Individual Student Admit Card')
    @section('content')
    <div class="app-title">
        <div>
          <h1><i class="fa fa-edit"></i>Section Wish Individual Student Admit Card</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Home</li>
          <li class="breadcrumb-item"><a href="#">Individual Student Admit Card</a></li>
        </ul>
    </div>
<div class="row justify-content-md-center">
    <div class="clearix"></div>
        <div class="col-md-9">
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
                            <select class="form-control" id="examName">
                                <option value=""> --Please Select--  </option>
                                @foreach ($exam as $exam)
                                    <option value="{{$exam->examName}}" >{{$exam->examName}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                        <label for="exampleFormControlSelect1"> student List</label>
                            <select class="form-control" id="studentList" >
                                <option value="">--Please Select--</option>
                               
                            </select>
                        </div>
                        @elseif (Auth::user()->hasAllPermissions('Class Teacher'))
                        <div class="form-group col-md-4">
                            <label for="exampleFormControlSelect1"> Exam</label>
                            <select class="form-control" id="examName">
                                <option value=""> --Please Select--  </option>
                                @foreach ($exam as $exam)
                                    <option value="{{$exam->examName}}" >{{$exam->examName}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exampleFormControlSelect1"> student List</label>
                            <select class="form-control" id="studentList" >
                                <option value=""> --Please Select--  </option>
                            @foreach (App\model\ClassTeacher::where('userId', Auth::user()->id)->with('Section')->get() as $classTeacher)
                                @if ($classTeacher->Section->sessionYear->status == 1)
                                {{-- <option value="">{{$classTeacher->sectionId}}</option> --}}
                                @foreach (App\model\Student::where('sectionId', $classTeacher->sectionId)->get() as $st)
                                <option value="{{$st->id}}">{{$st->firstName}}</option>
                                @endforeach
                                {{-- @foreach (App\model\Student::get() as $st)
                               
                                    <option value="{{$st->id}}">{{$st->firstName}} {{$st->lastName}} {{'('$st->roll')'}}</option>
                                   
                                
                                @endforeach --}}
                                

                                @endif
                            @endforeach
                        </select>
                                
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
<div id="indivi">
</div>
      <div class="clearix"></div>
    @endsection
    @section('script')
    @include('backend.partials.js.datatable');
      <script>
    dynamicSectionSelection();

    $('#sectionId').change(function (e) {
        e.preventDefault();

        var classId=$("#classId").val();
        var sectionId=$("#sectionId").val();

        //console.log(classId, sectionId);

        $.ajax({
                type: "get",
                url:"{{url('individual/admitCardSectionWiseList/')}}"+'/'+classId+'/'+sectionId,
                
                success: function (data) {
                    console.log(data);
                    var option="<option>--Please Select--</option>";
                    data.forEach(element => {

                        option+=("<option value='"+element.id+"'>"+element.firstName+' '+element.lastName+'('+element.roll+')'+"</option>");

                    });
                    $('#studentList').html(option);
                }
            });
       // ajax:"{{url('individual/admitCardSectionWiseList/')}}"+'/'+classId+'/'+sectionId,
        
    //table.destroy();

    });
    $('#studentList').change(function (e) {
        e.preventDefault();

        var studentId=$("#studentList").val();
        var examName=$("#examName").val();

        //console.log(classId, sectionId);

        $.ajax({
                type: "get",
                url:"{{url('print/studentAdmitCard')}}"+'/'+studentId+'/'+examName,
                
                success: function (data) {
                    
                    $('#indivi').html(data);
                }
            });
       // ajax:"{{url('individual/admitCardSectionWiseList/')}}"+'/'+classId+'/'+sectionId,
        
    //table.destroy();

    });




    </script>

    @endsection
