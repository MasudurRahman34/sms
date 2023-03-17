@extends('backend.layouts.master')
	@section('title', 'Student Admission Page')
    @section('content')
<div class="app-title">
    <div>
      <h1><i class="fa fa-edit"></i>Student Admission Form </h1>
      <p>Admission form</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item"><a href="studentAdmission.html">Student Admisssion</a></li>
    </ul>
  </div>
  <div class="row justify-content-md-center">
    <!--Start inline section-->
    <div class="clearix"></div>
    <div class="col-md-7">
      <div class="tile">
        <h3 class="tile-title border-bottom p-2">Student Admission Form</h3>
        <div class="tile-body">
        <!-- method="post" action="{{route('admission.store')}}" -->
          <!-- <form name="form" class="row" onSubmit="return validate()"> -->
          <form name="form" method="post" action="{{route('admission.store')}}" class="row" onSubmit="return validate()">
            @csrf
            <div class="col-md-12">
                    <div class="alert alert-warning text-center" role="alert">
                        Personal Information
                    </div>
            </div>
            <div class="form group col-md-6 {{$errors->has('firstName') ? 'has-error' : ''}}">
              <label class="control-label">First Name<span style="color: red;">*</span></label>
              <input class="form-control" name="firstName" id="firstName" type="text" value="{{old('firstName')}}" required>
              @if($errors->has('firstName'))
                <span class="help-block text-danger">
                  {{$errors->first('firstName')}}
                </span>
              @endif
            </div>

            <div class="form group col-md-6 {{$errors->has('lastName') ? 'has-error' : ''}}">
                <label class="control-label">Last Name<span style="color: red;">*</span></label>
                <input class="form-control" name="lastName" id="lastName" type="text" value="{{old('lastName')}}" required>
                @if($errors->has('lastName'))
                  <span class="help-block text-danger">
                    {{$errors->first('lastName')}}
                  </span>
                @endif
            </div>
            <div class="form group col-md-6">
                    <label class="control-label mt-3">Gender<span style="color: red;">*</span></label><br>
                    <label class="radio-inline"><input type="radio" name="gender" checked value="Male">Male</label>
                    <label class="radio-inline"><input type="radio" name="gender" value="Female">Female</label>
                    <label class="radio-inline"><input type="radio" name="gender" value="Other">Other</label>
            </div>
            <div class="form group col-md-6 {{$errors->has('mobile') ? 'has-error' : ''}}">
              <label class="control-label">Mobile No<span style="color: red;">*</span></label>
              <input class="form-control" id="mobile" name="mobile" type="number" maxlength="11" value="{{old('mobile')}}" required>
              @if($errors->has('mobile'))
                  <span class="help-block text-danger">
                    {{$errors->first('mobile')}}
                  </span>
                @endif
            </div>
            <div class="form-group col-md-6 {{$errors->has('birthDate') ? 'has-error' : ''}}">
                <label class=" control-label">Date of Birth<span style="color: red;">*</span></label>
                <div class="">
                  <input class="form-control" type="date" name="birthDate" id="birthDate" value="{{old('birthDate')}}" required>
                  @if($errors->has('birthDate'))
                  <span class="help-block text-danger">
                    {{$errors->first('birthDate')}}
                  </span>
                @endif
                </div>
              </div>
              <div class="form-group col-md-6 {{$errors->has('blood') ? 'has-error' : ''}}">
                <label for="exampleFormControlSelect1">Student BLood Group<span style="color: red;">*</span></label>
                <select class="form-control" id="blood" name="blood" required>
                <option value="">--Please Select--</option>
                  <option value="0+">O+</option>
                  <option value="0-">O-</option>
                  <option value="A-">A-</option>
                  <option value="A+">A+</option>
                  <option value="B+">B+</option>
                  <option value="B-">B-</option>
                  <option value="AB-">AB-</option>
                  <option value="AB+">AB+</option>
                </select>
                @if($errors->has('blood'))
                  <span class="help-block text-danger">
                    {{$errors->first('blood')}}
                  </span>
                @endif
              </div>
              <div class="col-md-12">
                <div class="alert alert-warning text-center" role="alert">
                    Educational Information
                </div>
            </div>

            <div class="form-group col-md-6">
                <label for="exampleFormControlSelect1">Session Year<span style="color: red;">*</span></label>
                <select class="form-control admission" id="sessionYear" name="sessionYear" required>
                  <option value="">--Please Select--</option>
                    @foreach ($SessionYear as $SYear)
                <option value="{{$SYear->id}}" data-sessionYear="{{$SYear->sessionYear}}" {{$SYear->status==1 ? 'selected' : ''}}>{{$SYear->sessionYear}}</option>
                    @endforeach
                </select>
              </div>
              <div class="form-group col-md-6">
                    <label class="control-label mt-3">Shift<span style="color: red;">*</span></label><br>
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
              <div class="form-group col-md-6">
                <label for="exampleFormControlSelect1">Select Class<span style="color: red;">*</span></label>
                <select class="form-control admission opsub" id="classId" name="classId">
                        <option value="">--Please Select--</option>
                    @foreach ($classes as $class)
                        <option value="{{$class->id}}">{{$class->className}}</option>
                    @endforeach
                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="exampleFormControlSelect1"> Section<span style="color: red;">*</span></label>
                <select class="form-control" id="sectionId" name="sectionId">
                    <option value="">--Please Select--</option>
                </select>
              </div>
              <div class="form group col-md-6 {{$errors->has('roll') ? 'has-error' : ''}}">
                <label class="control-label">Roll Number<span style="color: red;">*</span><sub id="lastRoll" class="text-danger"></sub></label>
                <input class="form-control" id="roll" name="roll" type="number" value="{{old('roll')}}">
                @if($errors->has('roll'))
                  <span class="help-block text-danger">
                    {{$errors->first('roll')}}
                  </span>
                @endif
              </div>
              <div class="form-group col-md-12">
                    <label class="control-label mt-3 bg-secondary text-light"><h5>Group<span style="color: red;">*</span></h5></label><br>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" name="group" id="group1" value="Gene ral" class="custom-control-input opsub" checked>
                        <label class="custom-control-label" for="group1">General (1 to 8)</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" name="group" id="group2" value="Science"  class="custom-control-input opsub">
                        <label class="custom-control-label" for="group2">Science</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" name="group" id="group3" value="Arts"  class="custom-control-input opsub">
                        <label class="custom-control-label" for="group3">Arts</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" name="group" id="group4" value="Commerce"  class="custom-control-input opsub">
                            <label class="custom-control-label" for="group4">Commerce</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" name="group" id="group5" value="Vocational" class="custom-control-input opsub">
                            <label class="custom-control-label" for="group5">Vocational</label>
                    </div>
                </div>

                  <div class="form-group col-md-6 opmainsubject" hidden>
                    <label for="exampleFormControlSelect1"> 4th subject</label>

                    <select class="form-control opubs" id="optionalSubjectId" name="optionalSubjectId[0]">
                        <option value="">--Select One--</option>
                    </select>
                  </div>
                  <div class="form-group col-md-6 opmainsubject" hidden>
                    <label for="exampleFormControlSelect1">Main Subject</label>

                    <select class="form-control opubs" id="optionalSubjectId" name="optionalSubjectId[1]">
                        <option value="">--Select One--</option>
                    </select>
                  </div>



              <div class="form-group col-md-4">
                <label class="control-label mt-3"><h5>Student Status<span style="color: red;">*</span></h5></label><br>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" name="type" id="type" value="regular" class="custom-control-input" checked>
                    <label class="custom-control-label" for="type">Regular</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" name="type" id="typeir" value="Irregular" class="custom-control-input">
                    <label class="custom-control-label" for="typeir">Irregular</label>
                </div>
            </div>
            <div class="col-md-12">
                <div class="alert alert-warning text-center" role="alert">
                    Tuition and Fees
                </div>
            </div>
            <div class="form-group col-md-4">
                <label class="control-label">Total Cost (TK)&nbsp;&nbsp;&nbsp;<span class="btn btn-light" id="btnToggle">Show Details </span></label>
                <input class="form-control" name="total" id="totalFee" type="number" readonly>

            </div>
            <div class="form-group col-md-4">
                <label for="exampleFormControlSelect1">Schoolarship</label>
                <select class="form-control" name="schoolarshipId" id="schoolarshipId">
                        <option value="0" selected>No</option>
                        @foreach (App\model\scholarship::where('bId', Auth::guard()->user()->bId)->get() as $scholarship)
                        <option value="{{$scholarship->id}}" data-discount="{{$scholarship->discount}}">{{$scholarship->name}} ({{$scholarship->discount}}%)</option>

                    @endforeach
                </select>
            </div>


            <div class="form-group col-md-4" id="schfee">
                <label for="exampleFormControlSelect1"><span class="p-5"><i class="fa fa-arrows-h" style="font-size:20px;" aria-hidden="true"></i></span>ON</label>
                <select class="form-control" name="forScholarshipFeeId" id="forScholarshipFeeId">


                </select>
            </div>

                <div class="col-md-12" id="feeList" style="display:none;">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead-light">
                                <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">Fee</th>
                                  <th scope="col">type</th>
                                  <th scope="col">Amount</th>
                                </tr>
                              </thead>
                              <tbody id="feeHtml">

                              </tbody>
                        </table>
                      </div>
            </div>
             <!--hidden field -->
            <input type="number" name="setDiscount" id="setDiscount" step="any" hidden>
            <input type="number" name="feeAmountAfterDiscount" id="feeAmountAfterDiscount" step="any" hidden>
            <input type="number" name="nokolTotalAmount" id="nokolTotalAmount" step="any" hidden>



            <!-- {{-- <div class="form-group col-md-6">
              <label for="exampleFormControlSelect1"> Fourth Subject</label>
              <select class="form-control admission" id="fourthSubject">
                <option>Highter Math</option>
                <option>ICT</option>
                <option>Agriculture</option>
                <option>Economics</option>
              </select>
            </div> --}} -->
            {{-- <div class="form-group col-md-12">
                    <label for=""> Picture</label>
                   <input type="file" name="" id="" class="form-control admission">
            </div> --}}
            <!-- {{-- <div class="form-group col-md-6">
              <div class="form-check">
                <label class="form-check-label check-inline">
                  <input class="form-check-input admission" type="checkbox" name="scholarship" value="yes">Schoolarship
                </label>
              </div>
            </div> --}} -->
          {{-- <div class="form-check">
            <label class="form-check-label check-inline">
              <input class="form-check-input admission" type="checkbox">I accept the terms and conditions
            </label>
          </div> --}}
        </div>
        <div class="tile-footer">
          <a class="btn btn-secondary" href="#"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>&nbsp;&nbsp;&nbsp;
        <button class="btn btn-primary float-right" id="register"><i class="fa fa-fw fa-lg fa-check-circle"></i>Register</button>
        </div>
        </form>
      </div>
    </div>
  </div>
@endsection
@section('script')
<script>

    $("#btnToggle" ).click(function() {
        $( "#feeList" ).toggle();
      });

$('#schfee').hide();
dynamicSectionSelection();
checkClassTenOrNine();
getFeesByClass();
$("#sectionId").change(function () {
var sectionId=$(this).val();
    lastRollFind(sectionId);
});

var sessionYear=$("#sessionYear option:selected").attr("data-sessionYear");
$("#sessionYear2").val(sessionYear);


//last role Find
function lastRollFind(sectionId){
    $.ajax({
        type: "get",
        url: "{{url('api/lastRoll')}}"+"/"+sectionId,
        success: function (response) {
            $("#lastRoll").html('Last Roll '+ response);
        }
    });
}



function checkClassTenOrNine(){
    $('.opsub').change(function (e) {

        e.preventDefault();
        var classId=$("#classId").val();
        var group = $("input[name='group']:checked").val();
        $.ajax({
            type: "get",
            url: "api/checkClassHasOptionalSubject"+"/"+classId+"/"+group,
            success: function (response) {
                    console.log(response.is_notEmpty);
                    if(response.is_notEmpty==0){
                        var option="";
                        $('.opmainsubject').attr('hidden', true);
                        $('.opubs').html(option);
                    }else{
                        $('.opmainsubject').attr('hidden', false);
                        var option="<option>--Please Select--</option>";
                        response.optionalsubject.forEach(element => {
                        option+=("<option value='"+element.id+"'>"+element.subjectName+"</option>");
                    });
                    $('.opubs').html(option);
                    }
            }
        });

    });
}



function getFeesByClass(){
$('#classId').change(function (e) {
    e.preventDefault();
    var classId = $(this).val();
    var sessionYearId=$("#sessionYear option:selected").val();
    $.ajax({
        type: "get",
        url: "/getAllFeesByClass"+"/"+classId+"/"+sessionYearId,

        success: function (response) {
            console.log(response);

            feeList="";
            $.each (response, function (key, value) {
                feeList +=
                "<tr>"+
                    "<td>"+
                        '<input class="fee" type="checkbox" name="fee['+value.id+']" value="'+value.amount+'" id="fee['+value.id+']" '+((value.status==1)? 'checked' : '')+'>'
                    +"</td>"+
                    "<td>"+value.name+"</td>"+
                    "<td>"+value.type+"</td>"+
                    "<td>"+value.amount+"</td>"+
              "</tr>"

              });
                    console.log(feeList);

            $('#feeHtml').html(feeList); //load to table
                var total = 0;
                $(".fee:checked").each(function() {
                    total += parseInt($(this).val());
                });//each end
                $("#totalFee").val(total);//load to total cost
                $("#nokolTotalAmount").val(total);
                $(".fee").click(function (e) {

                    var total = 0;
                    $(".fee:checked").each(function() {
                    total += parseInt($(this).val());
                });//each end
                $("#totalFee").val(total); //load to total coast after click
                $("#nokolTotalAmount").val(total); //load to total coast after click

                });//clck end

                //schoolarship fee load after change scholarship
                $("#schoolarshipId").change(function (e) {
                    e.preventDefault();
                    var schoolarshipId=$(this).val();
                    var discount=$("#schoolarshipId option:selected").attr("data-discount");

                    if(schoolarshipId=="0"){
                        $('#setDiscount').val('');
                        // $('.fee').attr('disabled', false);
                        $('.fee').css('pointer-events', 'auto');
                        $('#schfee').hide();
                        $('#forScholarshipFeeId').html("");
                            //back to previous calculation
                             var total = 0;
                            $(".fee:checked").each(function() {
                                total += parseInt($(this).val());
                            });//each end
                            $("#totalFee").val(total);//load to total cost
                            $("#nokolTotalAmount").val(total);
                            //

                    }else{
                        $('#setDiscount').val(discount);
                        $('#schfee').show();
                        // $('.fee').attr('disabled', "true");
                        $('.fee').css('pointer-events', 'none');
                        var option="<option value="+'no'+">--Please Select--</option>";
                        response.forEach(element => {
                        option+=("<option value='"+element.id+"' data-amount='"+element.amount+"'>"+element.name+"</option>");
                    });
                    $('#forScholarshipFeeId').html(option);
                    }//end if else
                    //inside schoolarshipId
                    var nokolTotalAmount=$("#nokolTotalAmount").val();
                    $("#forScholarshipFeeId").change(function (e) {
                        e.preventDefault();
                        $("#totalFee").val(nokolTotalAmount);
                        var amount=$("#forScholarshipFeeId option:selected").attr("data-amount");
                        var totalFee=$("#totalFee").val();
                        $('#feeAmountAfterDiscount').val(((amount-(amount*discount)/100)));
                        totalFee=totalFee-amount;
                        totalFee=totalFee+(amount-(amount*discount)/100);
                        $("#totalFee").val(totalFee);
                        console.log(discount, totalFee, amount);
                    });



                });
            }//succeess end


    });



});
}



function validate(){
    if(document.form.classId.selectedIndex==""){
    alert ( "Please Select class !");
    return false;
    }
    if(document.form.sectionId.selectedIndex==""){
    alert ( "Please Select section !");
    return false;
    }
    if(document.form.optionalSubjectId[0].selectedIndex==""){
    alert ( "Please Select optional SubjectId !");
    return false;
    }
    if(document.form.optionalSubjectId[1].selectedIndex==""){
    alert ( "Please Select Main Subject !");
    return false;
    }
    if(document.form.forScholarshipFeeId.selectedIndex==""){
      alert ( "Please Select Schoolarship Fee Type !");
      return false;
    }


}



</script>

@endsection
