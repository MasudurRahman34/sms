@extends('backend.layouts.master')
    @section('title', 'Admin|| Exam Attendance')

    @section('content')
    {{--  <link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/site-demos.css">  --}}
    <div class="app-title">
        <div>
          <h1><i class="fa fa-edit"></i>Section Wish Student Exam Attendance </h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Home</li>
          <li class="breadcrumb-item"><a href="#">ClassWise Student</a></li>
          <li class="breadcrumb-item"><a href="#">Exam Attendance</a></li>
        </ul>
    </div>
    @include('backend.partials._message')
<div class="row justify-content-md-center">

    <div class="clearix"></div>
        <div class="col-md-9">
            <div class="tile">
                <div class="tile-body">
                <div class="row">
                    <div class="form-group col-xs-2 pr-2">
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
                    <div class="form-group col-xs-2 pr-2">
                        <label for="exampleFormControlSelect1"> Group</label>
                        <select class="form-control changeGroupClass" id="group">
                            <option value=""> Please Select </option>
                            <option value="General"> General </option>
                            <option value="Science"> Science </option>
                            <option value="Arts"> Arts </option>
                            <option value="Commerce"> Commerce </option>
                    </select>
                    </div>
                <div class="form-group col-xs-2 pr-2">
                        <label for="exampleFormControlSelect1">Select Class</label>
                        <select class="form-control changeGroupClass" id="classId" name="classId">
                            <option value="">--Please Select--</option>
                            @foreach ($class as $class)
                            <option value="{{$class->id}}">{{$class->className}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-xs-2 pr-2">
                            <label for="exampleFormControlSelect1"> Subject Name</label>
                            <select class="form-control changeSubjectExamSection" id="subjectId" required>
                                    <option value="">--Please Select--</option>

                            </select>
                    </div>
                    <div class="form-group col-xs-2 pr-2">
                        <label for="exampleFormControlSelect1"> Exam Type</label>
                        {{-- <input class="form-control " type="text" id="examType" value="" name="examType" required> --}}
                        <select class="form-control changeSubjectExamSection" id="examType" name="examType" required>
                            <option value="">--Please Select--</option>

                    </select>
                    </div>

                    <div class="form-group col-xs-2">
                        <label for="exampleFormControlSelect1"> Section</label>
                        <select class="form-control changeSubjectExamSection" id="sectionId">
                            <option value=""> --Please Select--  </option>
                        </select>
                    </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
<div class="clearix"></div>
<div class="row justify-content-md-center">
    <div class="col-md-9 ">
        <div class="tile">
            {{-- need to add field for input --}}
                <div class="tile-body" id="tblHidden" hidden>
                    {{-- <form action="{{route('store.mark')}}" method="post" id="myform">  --}}
                        <div class="table-responsive" >
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                            <tr>
                                <th>Student Roll</th>
                                <th>Student Name</th>
                                <th>Attendence</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                        <button class="btn btn-primary" style="float: right;" id="btnAttn" onclick="btnAttendenceValidation()"><i class="fa fa-plus-square" aria-hidden="true" hidden></i>Take Exam Attendance </button>
                        </div>
                    {{--  </form>  --}}
                </div>
            </div>
    </div>
    <div class="clearix"></div>
    <!-- The Modal -->
    <div class="modal" id="newModal" >
      <div class="modal-dialog">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Fee Collection</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
              Attendance has been Taken  for This Exam, Do You Want to Update it!
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="examAttendance" data-dismiss="modal">Update List</button>
            <button type="button" class="btn btn-danger" id="cancel" data-dismiss="modal">Close</button>
          </div>

        </div>
      </div>
    </div>
    @endsection
    @section('script')
      <script>
       /* jQuery.validator.setDefaults({
            debug: true,
            success: "valid"
          });
          $( "#myform" ).validate({
            rules: {
              fruit: {
                required: true
              }
            }
          });
          */
          //function find subject name and section Name
        // $(document).ready( function () {

            function btnAttendenceValidation(){
                if(checkedAll()){
                    return btnAttendence();
                }else{
                    return false;
                }
            }

            function updateExamAttendanceValidation(){
                if(checkedAll()){
                    return updateExamAttendance();
                }else{
                    return false;
                }
            }

        {{--  function checkedAtlestOne(){

            $("#myfeeform").submit(function () {
                var idChecked= new Array;
                var roll=true;
                $("#myfeeform input[type=checkbox]:checked").each(function(){
                    idChecked.push(this.value);
                });
                if(idChecked.length>0){
                    return roll=true;
                }else{
                    alert('missing');
                    roll= false;
                }return roll;

                });

        }  --}}

        function checkedAll(){


              var roll=true;
              $(":radio").each(function () {
                name=$(this).attr('class');

                if(roll && !$(':radio[class="'+name+'"]:checked').length){
                  alert(' You Are missing Roll: '+ name);
                  console.log(name);
                  roll=false;
                }
              });
              return roll;

          };

        //on change validation
        $('.changeGroupClass').change(function (e) {
        e.preventDefault();

        $('#tblHidden').attr('hidden',true);
        $('#btnAttendance').attr('disabled',true);

        var classId= $("#classId option:selected").val();
        var sessionYearId=$('#sessionYear option:selected').val();
        var shift=$('input[name="shift"]:checked').val();
        var group=$('#group option:selected').val();
        console.log(classId,group);
        var url='/api/search/sectionbyclass';
        var data= {
            'classId' : classId,
            'sessionYearId' : sessionYearId,
            'shift' : shift,
            'group' : group,
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
                    console.log(data);
                    var option="<option>--Please Select--</option>";
                    data.forEach(element => {

                        option+=("<option value='"+element.id+"'>"+element.sectionName+"</option>");

                    });
                    $('#sectionId').html(option);
                }
            });
            $.ajax({
                type: "post",
                url:'/api/search/classsubject',
                data: data,
                success: function (data) {
                    console.log(data);
                    var option="<option>--Please Select--</option>";
                    data.forEach(element => {

                        option+=("<option value='"+element.id+"' data-optionalstatus='"+element.optionalstatus+"'>"+element.subjectName+"</option>");

                    });
                    $('#subjectId').html(option);
                }
            });

            $.ajax({
                type: "post",
                url:'/exam/search/examlist',
                success: function (data) {
                   // console.log(data);
                   var option="<option>--Please Select--</option>";
                    data.forEach (data => {
                        option+=("<option value='"+data.id+"'>"+data.examName+"</option>");

                    });
                    $('#examType').html(option);
                }
            });
        }
    });

    $('.changeSubjectExamSection').change(function (e) {
    e.preventDefault();
    var eventCategory=$("input[name=txtCategory]").val();
    var classId=$("#classId").val();
    var sectionId=$("#sectionId").val();
    var group=$('#group option:selected').val();
    var subjectId=$('#subjectId option:selected').val();
    var optionalstatus=$('#subjectId option:selected').attr('data-optionalstatus');
    var examType=$("#examType option:selected").val();
    var sessionYearId=$('#sessionYear option:selected').val();
    var shift=$('input[name="shift"]:checked').val();

        if(sectionId>0 && examType>0 && subjectId>0){
            $('#tblHidden').attr('hidden',true);
            $('#btnAttendance').attr('disabled',true);
        $.ajax({
          type: "post",
          url: "{{ url('adminview/student/studentData')}}",
          data: {
            sectionId:sectionId,
            group:group,
            subjectId:subjectId,
            optionalstatus:optionalstatus,
            sessionYearId: sessionYearId,
            shift: shift,
            classId: classId,
            examType: examType,
          },
          success: function (response) {
            console.log(response);

            //start change form here
            if(response.AttendStudents){
            //update Exam Attendance List
            $("#newModal").modal("show");
            $("#examAttendance").click(function(e){

                $('#tblHidden').attr('hidden',false);
                $('#btnAttendance').attr('disabled',false);
                $("#btnAttn").attr('onclick', 'updateExamAttendanceValidation()').html("Update Exam Attendance");
                var tr='';
                $.each (response.AttendStudents, function (key, value) {
                tr +=
                "<tr>"+
                    "<td>"+value.roll+"</td>"+
                    "<td>"+value.firstName+"</td>"+
                    "<td>"+
                    '<label class="radio"><input class="'+value.roll+'" type="radio" name="'+value.id+'" value="present" '+((value.examAttendence=="present")? 'checked' : '')+' >Present</label>'+
                    '<label class="radio"><input class="'+value.roll+'" type="radio" name="'+value.id+'" value="absent" '+((value.examAttendence=="absent")? 'checked' : '')+'>Absent</label>'
                    +"</td>"+
                "</tr>";

                //$("input[name='"+value.id+"'][value='"+value.examAttendence+"']").prop('checked', true);
            });

            $('tbody').html(tr);


            });
            }else{
                if(response!=0){

                    $('#tblHidden').attr('hidden',false);
                    //$('#btnAttendance').attr('disabled',false);
                    var tr='';
                    $.each (response, function (key, value) {
                        tr +=
                            "<tr>"+
                                "<td>"+value.roll+"</td>"+
                                "<td>"+value.firstName+"</td>"+
                                "<td>"+
                                '<label class="radio"><input class="'+value.roll+'" type="radio" name="'+value.id+'" value="present">Present</label>'+
                                '<label class="radio"><input class="'+value.roll+'" type="radio" name="'+value.id+'" value="absent">Absent</label>'
                                +"</td>"+
                            "</tr>";

                        });
                        $('tbody').html(tr);
                    }//End if
                }//end else
            } //End success
        }); //end ajax
    }//end section >0
}); //end section onchabge


function updateExamAttendance(){
    alert("Update Exam Attendance");
    var sessionYearId=$('#sessionYear option:selected').val();
    var shift=$('input[name="shift"]:checked').val();
    var group=$('#group option:selected').val();
    var classId= $("#classId option:selected").val();
    var subjectId=$('#subjectId option:selected').val();
    var examType=$("#examType option:selected").val();
    var sectionId=$("#sectionId").val();
    var examAttendence = $("tr input:radio:checked").map(function(){
        return $(this).val();
      }).get();
    var key = $("tr input:radio:checked").map(function(){
        return $(this).attr('name');
      }).get();
    var Attendence = key.reduce((r, e, i) => (r[e]= examAttendence[i], r), {})
    console.log(Attendence);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        },
    });
    var url="{{url('/adminview/student/examattendance/update')}}"
    //ajax
    jQuery.ajax({
        method: 'post',
        url: url,
        data: {
            sessionYearId: sessionYearId,
            shift: shift,
            group: group,
            classId: classId,
            subjectId: subjectId,
            examType: examType,
            sectionId: sectionId,
            Attendence:Attendence,
        },
        success: function(result){
            console.log(result);
            if (result.success) {
               $( "div" ).remove( ".text-danger" );
                successNotification3();
                //removeUpdateProperty("exam");
                //document.getElementById("myform").reset();
            }
            if(result.errors){
                getError(result.errors);
            }
        }
    });//end
}

function btnAttendence(){
    alert('Take Exam Attendence');
    var sessionYearId=$('#sessionYear option:selected').val();
    var shift=$('input[name="shift"]:checked').val();
    var group=$('#group option:selected').val();
    var classId= $("#classId option:selected").val();
    var subjectId=$('#subjectId option:selected').val();
    var examType=$("#examType option:selected").val();
    var sectionId=$("#sectionId").val();
    var examAttendence = $("tr input:radio:checked").map(function(){
        return $(this).val();
      }).get();
    var key = $("tr input:radio:checked").map(function(){
        return $(this).attr('name');
      }).get();
    var Attendence = key.reduce((r, e, i) => (r[e]= examAttendence[i], r), {})
      console.log(Attendence);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        },
    });
    var url="{{url('/adminview/student/examattendance/store')}}"
    //ajax
    jQuery.ajax({
        method: 'post',
        url: url,
        data: {
            sessionYearId: sessionYearId,
            shift: shift,
            group: group,
            classId: classId,
            subjectId: subjectId,
            examType: examType,
            sectionId: sectionId,
            Attendence:Attendence,
        },
        success: function(result){
            if (result.success) {
                $( "div" ).remove( ".text-danger" );
                console.log(result);
                successNotification2();

                //removeUpdateProperty("exam");
                //document.getElementById("myform").reset();
            }
            if(result.errors){
                getError(result.errors);
            }
        }
    });//end
}

</script>
@endsection
