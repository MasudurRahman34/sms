@extends('backend.layouts.master')
	@section('title', 'Result Management')
    @section('content')
    {{-- //main content --}}
    <div class="app-title">
        <div class="hmmm">
          <h1><i class="fa fa-edit"></i> Result</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Home / Admin</li>
          <li class="breadcrumb-item"><a href="#">Result</a></li>
        </ul>
    </div>
    @include('backend.partials._message')
    <div class="row justify-content-md-center" >

        <div class="clearix"></div>
            <div class="col-md-10">
                <div class="tile">

                    <h3 class="tile-title border-bottom p-2">Individual Result</h3>
                    <div class="tile-body">
                    <div class="row">
                        @if (Auth::user()->hasPermissionTo('Result'))
                        <div class="form-group col-xs-3 pr-2">
                            <label for="exampleFormControlSelect1">Session Year</label>
                            <select class="form-control " id="sessionYear" >
                                <option value="">--Please Select--</option>
                                @foreach ($sessionYear as $year)
                                    <option value="{{$year->id}}" {{$year->status == 1 ? 'selected': ''}}>{{$year->sessionYear}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-xs-2">
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

                        <div class="form-group col-xs-3 pr-2">
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
                            <select class="form-control changeSubjectExamSection" id="sectionId">
                                <option value=""> --Please Select--  </option>
                            </select>
                        </div>
                        <div class="form-group col-xs-2 pr-2">
                            <label for="exampleFormControlSelect1"> Exam Type</label>
                            <select class="form-control changeSubjectExamSection" id="examType" name="examType" required>
                                <option value="">--Please Select--</option>
                                @foreach ($exams as $exam)
                                <option value="{{$exam->id}}">{{$exam->examName}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="exampleFormControlSelect1"> Student Name/Roll/Id</label>
                            <select class="form-control studentIdAndfeeId" id="studentId" required>
                                <option value=""> --Please Select--  </option>
                            </select>
                        </div>
                        @elseif (Auth::user()->hasAllPermissions('Class Teacher'))
                        <div class="form-group col-xs-2 pr-2">
                            <label for="exampleFormControlSelect1"> Exam Type</label>
                            <select class="form-control changeSubjectExamSection" id="examType" name="examType" required>
                                <option value="">--Please Select--</option>
                                @foreach ($exams as $exam)
                                <option value="{{$exam->id}}">{{$exam->examName}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exampleFormControlSelect1"> student Name/Roll</label>
                            <select class="form-control studentIdAndfeeId" id="studentId" >
                                <option value=""> --Please Select--  </option>
                            @foreach (App\model\ClassTeacher::where('userId', Auth::user()->id)->with('Section')->get() as $classTeacher)
                                @if ($classTeacher->Section->sessionYear->status == 1)
                                {{-- <option value="">{{$classTeacher->sectionId}}</option> --}}
                                @foreach (App\model\Student::where('sectionId', $classTeacher->sectionId)->get() as $st)
                                <option value="{{$st->id}}">{{$st->firstName}} {{$st->lastName}} ({{$st->roll}})</option>
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
        
        <div class="table"  id="result">
            
        </div>

    <div class="clearix"></div>
   
    @endsection
    @section('script')
    @include('backend.partials.js.datatable');

    
    <script>
        // $('#informationDiv').attr('hidden',true);
        // $('#resultDiv').attr('hidden',true);
        // 
function show(){
    $('#f').attr('hidden',false);
}
function hide(){
    $('#f').attr('hidden',true);
}


    $('.admission').change(function (e) {
        e.preventDefault();

        // $('#informationDiv').attr('hidden',true);
        // $('#resultDiv').attr('hidden',true);
        var classId= $("#classId").val();
        var sessionYearId=$('#sessionYear').val();
        var shift=$('input[name="shift"]:checked').val();
        console.log(classId);
        var url='/api/search/sectionbyclass';
        var data= {
            'classId' : classId,
            'sessionYearId' : sessionYearId,
            'shift' : shift,
        }
        if(classId>0){
            $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        },
                    });
            $.ajax({
                type: "post",
                url:url,
                data: data,
                success: function (data) {
                    var option="<option>--Please Select--</option>";
                    data.forEach(element => {
                        option+=("<option value='"+element.id+"'>"+element.sectionName+"</option>");
                    });
                    $('#sectionId').html(option);
                }
            });
        }
    });

    //Get fee amount in change of fee name
    $('#sectionId').change(function (e) {
        e.preventDefault();

        sectionId=$(this).val();

        
        console.log(sectionId);
                $.ajax({
                    type: "POST",
                    url: "{{ url('feecollection/individualStudent')}}",
                    data: {
                    sectionId:sectionId,
                    //feeId:feeId,
                    // month:month,
                    },
                    success: function (data) {
                    //change start from here
                    var option="<option>--Please Select--</option>";
                    data.forEach(element => {
                        option+=("<option value='"+element.id+"'>"+element.firstName+' '+element.lastName+'/ Roll- '+element.roll+'/ ID- '+element.studentId+' '+"</option>");
                        });
                        $('#studentId').html(option);
                        }
                    });
        });//end sectionId
        //Get fee amount in change of fee name
    $('#studentId').change(function (e) {
        e.preventDefault();


        $('#informationDiv').attr('hidden',false);
        $('#resultDiv').attr('hidden',false);
        $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        },
                    });

        sectionId=$('#sectionId option:selected').val();
        var classId= $("#classId").val();
        var studentId= $("#studentId option:selected").val();
         var sessionYearId=$('#sessionYear option:selected').val();
         var examType=$('#examType option:selected').val();
         var examTypeName=$('#examType option:selected').text();
        console.log(sectionId,classId,studentId,sessionYearId,examType,examTypeName);
                $.ajax({
                    type: "POST",
                    url: "{{ url('adminview/student/resultlist')}}",
                    data: {
                    sectionId:sectionId,
                    studentId:studentId,
                    sessionYearId:sessionYearId,
                    examType:examType,
                    examTypeName:examTypeName
                    //feeId:feeId,
                    // month:month,
                    },
                    success: function (data) {
                        //console.log(data.studentinformation);
                        console.log(data);
                        console.log(data.studentinformation);

                       $('#name').html(examTypeName);
                    //change start from here
                    //
                            // var tr='';
                            // $.each (data, function (key, value) {
                            // tr +=
                            //     "<tr>"+
                                    
                            //         "<td>"+value.firstName+" "+value.lastName+"</td>"+
                            //         "<td>"+value.roll+"</td>"+
                                
                            //     "</tr>";
                            // });

                            $('#StudentInformation').html(data.studentinformation);
                            $('#gradesInformation').html(data.gradeinfo);
                            // $('#myresult').html(data.result);
                            $('#result').html(data);
                    
                        }
                    });
  
        });//end sectionId





        // function printDiv(divName) {
        //     var printContents = document.getElementById(divName).innerHTML;
        //     var originalContents = document.body.innerHTML;
        //     document.body.innerHTML = printContents;
        //     document.getElementById("doPrint").style.visibility = "hidden";
        //     //document.getElementById("more-result").style.visibility = "hidden";
        //     window.print();
        //     document.body.innerHTML = originalContents;
        //     //document.location.reload();
        // }


//print button in table


    </script>
    @endsection
