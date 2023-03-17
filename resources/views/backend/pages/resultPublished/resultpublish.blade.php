@extends('backend.layouts.master')
    @section('title', 'Admin|| Marks Entry')

    @section('content')
    <div class="app-title">
        <div>
          <h1><i class="fa fa-edit"></i>Section Wish Student Marks Distribution </h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item"><a href="#">ClassWise Student</a></li>
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
                        <label for="exampleFormControlSelect1">Select Class</label>
                        <select class="form-control changeClass" id="classId" name="classId">
                            <option value="">--Please Select--</option>
                            @foreach ($class as $class)
                            <option value="{{$class->id}}">{{$class->className}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-xs-2 pr-2">
                        <label for="exampleFormControlSelect1"> Exam Type</label>
                        <select class="form-control changeExamtypeSectionid" id="examType" name="examType" required>
                            <option value="">--Please Select--</option>
                        </select>
                    </div>

                    <div class="form-group col-xs-2 pr-2">
                        <label for="exampleFormControlSelect1"> Section</label>
                        <select class="form-control changeExamtypeSectionid" id="sectionId">
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
    <div class="col-md-10 ">
        <div class="tile">
            {{-- need to add field for input --}}
                <div class="tile-body" id="tblHidden" hidden>
                    {{-- <form action="{{route('store.mark')}}" method="post" id="attendence"> --}}
                        @csrf
                       {{-- <input type="text" name="stid" id="stid" hidden>
                        <input type="text" name="classId2" id="classId2" hidden>
                       <input type="text" name="subjectId2" id="subjectId2" hidden>
                       <input type="text" name="markType2" id="markType2" hidden>  --}}
                        <div class="table-responsive" >
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                            <tr>
                                <th>subject Name</th>
                                <th>number of Student (Mark Entry)</th>
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
</div>
<div class="clearix"></div>
    @endsection
    @section('script')

      <script>

        $('.changeClass').change(function (e) {
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
                url:'/exam/search/examlist',
                success: function (data) {
                    console.log(data);
                   var option="<option>--Please Select--</option>";
                    data.forEach (data => {
                        option+=("<option value='"+data.id+"'>"+data.examName+"</option>");

                    });
                    $('#examType').html(option);
                }
            });
        }
    });

    $('.changeExamtypeSectionid').change(function (e) {
    e.preventDefault();
    var classId=$("#classId").val();
    var sectionId=$("#sectionId").val();
    var subjectId=$("#subjectId option:selected").val();
    var examType=$("#examType option:selected").val();
    var sessionYearId=$('#sessionYear option:selected').val();

    //console.log(classId, sectionId,subjectId,examType,group);
        if(sectionId>0 && examType>0){
            $('#tblHidden').attr('hidden',true);
            $('#btnAttendance').attr('disabled',true);
        $.ajax({
          type: "get",
          url: "{{ url('/api/search/subjectListFromMarkTable')}}",
          data: {
            sectionId:sectionId,
            examType:examType,
            sessionYearId:sessionYearId,
            classId:classId,
          },
          success: function (response) {
           // console.log(response);
            if(response!=0){
                $('#tblHidden').attr('hidden',false);
                $('#btnAttendance').attr('disabled',false);
                var tr='';
                $.each (response, function (key, value) {
                    tr +=
                        "<tr>"+
                            "<td>"+value.subjectName+"</td>"+
                            "<td>"+value.numberOfStudent+"</td>"+
                            "<td>"+
                            '<button class="btn btn-sm-primary " onClick="publish('+value.id+')" name="button'+value.id+'" id="submit'+value.id+'" ><i class="" aria-hidden="true"></i>Publish</button>'
                            +"</td>"+
                        "</tr>";
                    });
                    $('tbody').html(tr);
                }
            } //End if
        });
    }//end section
});

function publish(id){
   // console.log(id);
    var subjectId=id;
    var sessionYearId=$('#sessionYear option:selected').val();
    var examType=$("#examType option:selected").val();
    var classId=$("#classId option:selected").val();
    var sectionId=$("#sectionId option:selected").val();
    console.log(subjectId,sessionYearId,examType,classId,sectionId);
   // $('#submit'+id+'').html("Updated");
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
        });
        var url="{{url('/adminview/student/resultPublished/update')}}"
        console.log(url);
        //ajax
        jQuery.ajax({
            method: 'post',
            url: url,
            data: {
                sessionYearId: sessionYearId,
                subjectId: subjectId,
                classId: classId,
                sectionId: sectionId,
                examType: examType,
            },
            success: function(result){

                console.log(result);
                
                if (result.success) {
                    $( "div" ).remove( ".text-danger" );
                    console.log(result);
                        successNotification3();

                    $('input[name=button'+id+']').html("Updated");
                    $('#submit'+id+'').html("Updated");

                }
                if(result.errors){
                    getError(result.errors);
                }
            } //End success
        });//end ajax
    }//End function
</script>
@endsection
