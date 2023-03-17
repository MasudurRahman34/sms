@extends('backend.layouts.master')
    @section('title', 'Admin|| Marks Entry')

    @section('content')
    {{--  <link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/site-demos.css">  --}}
    <div class="app-title">
        <div>
          <h1><i class="fa fa-edit"></i>Section Wise Student Marks Distribution </h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item"><a href="#">Section Wise Student</a></li>
          <li class="breadcrumb-item"><a href="#">Mark Entry</a></li>
        </ul>
    </div>
    @include('backend.partials._message')
<div class="row justify-content-md-center">

    <div class="clearix"></div>
        <div class="col-md-10">
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
                                    {{-- @foreach ($subjects as $subject)
                                    <option value="{{$subject->id}}">{{$subject->subjectName}}</option>
                                    @endforeach --}}
                            </select>
                    </div>
                    <div class="form-group col-xs-2 pr-2">
                        <label for="exampleFormControlSelect1"> Exam Type</label>
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
    <div class="col-md-12 ">
        <div class="tile">
            {{-- need to add field for input --}}
                <div class="tile-body" id="tblHidden" hidden>
                    {{-- <form action="{{route('store.mark')}}" method="post" id="attendence"> --}}
                        @csrf
                       <input type="text" name="stid" id="stid" hidden>
                       {{--  <input type="text" name="classId2" id="classId2" hidden>
                       <input type="text" name="subjectId2" id="subjectId2" hidden>
                       <input type="text" name="markType2" id="markType2" hidden>  --}}
                        <div class="table-responsive" >
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                            <tr>
                                <th>Roll</th>
                                <th>Name</th>
                                <th>Exam Attendance</th>
                                
                                {{-- <th>CA <b id="thsubca" ></b> %</th> --}}
                                <th>MCQ</th>
                                {{-- <th>MCQ <b id="thsubmcq" ></b> %</th> --}}
                                <th>Written</th>
                                {{-- <th>written <b id="thsubwritten" ></b> %</th> --}}
                                <th>Practical</th>
                                {{-- <th>Practical <b id="thsubpractcle" ></b> %</th> --}}
                                <th>Total in 80 %</th>
                                <th>CA</th>
                                {{-- <th></th> --}}
                                <th>Total</th>
                                <th>Grade</th>
                                <th>Point</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>


                            </tbody>
                        </table>
                        </div>
                       {{--  <button class="btn btn-primary " type="submit" id="btnAttendance" disabled="true"><i class="fa fa-plus-square" aria-hidden="true"></i>Attendance</button>  --}}
                    {{-- </form> --}}
                </div>
            </div>
    </div>

      <div class="clearix"></div>
    @endsection
    @section('script')
    {{--  <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>  --}}
      {{-- @include('backend.partials.js.datatable'); --}}
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
        $('.changeGroupClass').change(function (e) {
        e.preventDefault();

        $('#tblHidden').attr('hidden',true);
        $('#btnAttendance').attr('disabled',true);

        var classId= $("#classId option:selected").val();
        var sessionYearId=$('#sessionYear option:selected').val();
        var shift=$('input[name="shift"]:checked').val();
        var group=$('#group option:selected').val();
       // console.log(classId,group);

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
                 //   console.log(data);
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
                  //  console.log(data);
                    var option="<option>--Please Select--</option>";
                    data.forEach(element => {

                        option+=("<option value='"+element.id+"' data-optionalstatus='"+element.optionalstatus+"' data-subca='"+element.ca+"' data-submcq='"+element.mcq+"'  data-subwritten='"+element.written+"' data-subpracticle='"+element.practicle+"'>"+element.subjectName+"</option>");

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
    var classId=$("#classId").val();
    var sectionId=$("#sectionId").val();
    var group=$('#group option:selected').val();
    var eventCategory=$("input[name=txtCategory]").val();
    var subjectId=$("#subjectId option:selected").val();
    var examType=$("#examType").val();
    var optionalstatus=$('#subjectId option:selected').attr('data-optionalstatus');

    var subca=$('#subjectId option:selected').attr('data-subca');
    var submcq=$('#subjectId option:selected').attr('data-submcq');
    var subwritten=$('#subjectId option:selected').attr('data-subwritten');
    var subpracticle=$('#subjectId option:selected').attr('data-subpracticle');

    var sessionYearId=$('#sessionYear option:selected').val();

    //console.log(classId, sectionId,subjectId,examType,group);
        if(sectionId>0 && examType>0 && subjectId>0){
            $('#tblHidden').attr('hidden',true);
            $('#btnAttendance').attr('disabled',true);
        $.ajax({
          type: "post",
          url: "{{ url('adminview/student/studenlist')}}",
          data: {
            sectionId:sectionId,
            examType:examType,
            subjectId:subjectId,
            sessionYearId:sessionYearId,

          },

          success: function (response) {
           // console.log(response);
            if(response!=0){

                $('#tblHidden').attr('hidden',false);
                $('#btnAttendance').attr('disabled',false);
                $('#thsubca').html(subca);
                $('#thsubmcq').html(submcq);
                $('#thsubwritten').html(subwritten);
                $('#thsubpractcle').html(subpracticle);

                var tr='';
                $.each (response, function (key, value) {
                    tr +=
                        "<tr>"+
                            "<td>"+value.roll+"</td>"+
                            "<td>"+value.firstName+" "+value.lastName+"</td>"+
                            "<td>"+value.examAttendence+"</td>"+
                            

                            "<td>"+
                                '<input class="marks validation" type="number" min="0" max="100" name="mcq'+value.id+'" value="'+value.mcq+'" onblur="checkGrade('+value.id+')" '+((value.examAttendence=="absent")? 'readonly' : '')+'>'
                            +"</td>"+
            

                            "<td>"+
                            '<input class="marks validation" type="number" min="0" max="100" name="writting'+value.id+'" value="'+value.written+'" onblur="checkGrade('+value.id+')" '+((value.examAttendence=="absent")? 'readonly' : '')+' >'
                            +"</td>"+

                            "<td>"+
                            '<input class="marks validation" type="number" min="0" max="100" name="practical'+value.id+'" value="'+value.practical+'" onblur="checkGrade('+value.id+')" '+((value.examAttendence=="absent")? 'readonly' : '')+' >'
                            +"</td>"+

                            
                            "<td>"+
                            '<input class="totalEightyPercentMark forTotal validation " type="number" min="0" max="100" name="totalEightyPercentMark'+value.id+'" value="'+value.total+'" >'
                            +"</td>"+

                            "<td>"+
                            '<input class="forTotal validation" type="number" min="0" max="20" name="ca'+value.id+'" value="'+value.ca+'" onblur="checkGrade('+value.id+')" '+((value.examAttendence=="absent")? 'readonly' : '')+' >'
                            +"</td>"+

                            // "<td>"+
                            // '<input class="totalMarksin80 validation " type="number" min="0" max="100" name="totalMarksin80'+value.id+'" value="'+value.total+'" onblur="checktotalin80('+value.id+')" readonly>'
                            // +"</td>"+

                            "<td>"+
                            '<input class="caltotalMarks validation " type="number" min="0" max="100" name="caltotalMarks'+value.id+'" value="'+value.total+'" onblur="checkGrade('+value.id+')" readonly>'
                            +"</td>"+

                            "<td>"+
                            '<input class="grade " type="text" name="grade'+value.id+'" value="'+value.gradeName+'" readonly>'
                            +"</td>"+
                            "<td>"+
                            '<input class="grade " type="number" name="gradePoint'+value.id+'" value="'+value.gradePoint+'" readonly>'
                            +"</td>"+
                            "<td>"+
                            '<button class="btn btn-primary " onClick="sendMark('+value.id+')" name="button'+value.id+'" id="submit'+value.id+'" ><i class="fa fa-plus-square" aria-hidden="true"></i>Save</button>'
                            +"</td>"+


                        "</tr>";
                    });

                    $('tbody').html(tr);

                    //80 % mark
                    $(document).keyup(function(){
                        //alert("ok");
                        $("tr").each(function(){
                            var totalEightyPercentMark =0;
                            $(this).find(".marks").each(function(){

                               var marks=$(this).val();
                                if(marks.length!==0){
                                    totalEightyPercentMark +=parseInt(marks)*.8;
                                }
                           });
                            var totalEightyPercentMark= $(this).find(".totalEightyPercentMark").attr('value', totalEightyPercentMark);
                            var total=0;
                            $(this).find(".forTotal").each(function(){
                                
                                var forTotal=$(this).val();
                                
                                
                                if(forTotal.length!==0){
                                    total +=parseInt(forTotal);
                                    console.log(total);
                                }
                            });
                            var total= $(this).find(".caltotalMarks").attr('value', total);

                        });
                    });//end
                }
            } //End if
        });
    }//end section

});


//check 
// function checktotalin80(id){
//    // console.log(id);
//     //var ca= $('input[name=ca'+id+']').val();
//     var mcq= $('input[name=mcq'+id+']').val()
//     var written= $('input[name=writting'+id+']').val();
//     var practical= $('input[name=practical'+id+']').val();
    
//     var mwptotal = Number(mcq) + Number(written) + Number(practical);
    
//    // console.log(mcq,written,practical,mwptotal);
//     var cal80percenttotal =(mwptotal*80)/100;
//     //console.log(cal80percenttotal);


//     //var calpractical=(inputpractical*subpracticle)/100;
//     //$("#classId2").attr('value',classId);
//      $('input[name=totalMarksin80'+id+']').attr('value',cal80percenttotal);

//      var precent= $('input[name=totalMarksin80'+id+']').val();

//      var ca= $('input[name=ca'+id+']').val();

//      var cal =Number(precent)+ Number(ca);

//      $('input[name=caltotalMarks'+id+']').attr('value',cal);

   
//     }      

function checkGrade(id){
   // console.log(id);
   // change caltotal
    var totalMarks= $('input[name=caltotalMarks'+id+']').val();
//console.log(totalMarks);

//change start from here
        $.ajax({
            type: "post",
            url:'/grade/search/gradelist',
            success: function (data) {
               // console.log(data);
                $.each (data, function (key, value) {
                    if(totalMarks<=value.maxValue && totalMarks>=value.minValue){
                        $('input[name=grade'+id+']').attr('value',value.gradeName);
                        $('input[name=gradePoint'+id+']').attr('value',value.gradePoint);
                    }
                    var grade= $('input[name=grade'+id+']').val();
                    var gradePoint= $('input[name=gradePoint'+id+']').val();

                });

            }
        });



    var grade= $('input[name=grade'+id+']').val();
   // console.log(grade);
    }


function sendMark(id){
   // console.log(id);
    var studentid=id;
    $('input[name=stid]').attr('value',studentid);
    var sessionYearId=$('#sessionYear option:selected').val();
    var subjectId=$('#subjectId option:selected').val();
    var examType=$("#examType option:selected").val();

   // console.log(studentid);
    var ca= $('input[name=ca'+id+']').val();
    var mcq= $('input[name=mcq'+id+']').val();
    var written= $('input[name=writting'+id+']').val();
    var practical= $('input[name=practical'+id+']').val();
    var totalEightyPercentMark= $('input[name=totalEightyPercentMark'+id+']').val();
    //change caltotal
    var totalMarks= $('input[name=caltotalMarks'+id+']').val();

    if(totalMarks>=100){
        alert("Total mark Can not be More then 100! please Check it Again");
    }else{
        var totalMarks =totalMarks;
        var grade= $('input[name=grade'+id+']').val();
        var gradePoint= $('input[name=gradePoint'+id+']').val();
    // console.log(ca,mcq,written,practical,totalMarks,grade,gradePoint);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
        });
        var url="{{url('/adminview/student/markstore')}}"
        //ajax

        jQuery.ajax({
            method: 'post',
            url: url,
            data: {
                studentid:studentid,
                sessionYearId: sessionYearId,
                subjectId: subjectId,
                examType: examType,

                ca: ca,
                mcq: mcq,
                written: written,
                practical: practical,
                totalEightyPercentMark: totalEightyPercentMark,
                totalMarks: totalMarks,
                grade: grade,
                gradePoint: gradePoint,
            },
            success: function(result){
                if (result.success) {
                    $( "div" ).remove( ".text-danger" );
                console.log(result);
                    successNotification3();
                        //var id= JSON.parse(result.id);
                        id=$('#stid').val();
                        console.log(id);

                $('input[name=button'+id+']').html("Updated");
                $('#submit'+id+'').html("Update");


                    //removeUpdateProperty("exam");
                    //document.getElementById("myform").reset();
                }
                if(result.errors){
                    getError(result.errors);
                }
            } //End success
        });//end ajax
    }//end else


    }//End function


</script>

@endsection
