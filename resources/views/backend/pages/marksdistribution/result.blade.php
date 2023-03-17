@extends('backend.layouts.master')
	@section('title', 'Result Management')
    @section('content')
    {{-- //main content --}}
    <div class="app-title">
        <div class="hmmm">
          <h1><i class="fa fa-edit"></i> Result2</h1>
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

                    <h3 class="tile-title border-bottom p-2">Student Search</h3>
                    <div class="tile-body">
                    <div class="row">
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
                            <label for="exampleFormControlSelect1"> Student Name/Roll/ID</label>
                            <select class="form-control studentIdAndfeeId" id="studentId" required>
                                <option value=""> --Please Select--  </option>
                            </select>
                        </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-md-center">

            <div class="col-sm-10" id="print_div">
                <input class="bg-warning text-dark float-right" type='button' value='Print' id='doPrint'>
                <div class="row" id="informationDiv">

                    <div class="col-md-6 ">
                        <div class="tile">

                            <h3 class=" row justify-content-md-center">Student Information</h3>
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered" id="sampleTable">
                                    <thead>
                                        <tr>

                                            <th>Student Name </th>
                                            <th>Roll</th>
                                            <th>Class</th>
                                            <th>Section</th>
                                            <th>Session Year</th>

                                        </tr>
                                    </thead>
                                    <tbody  id="StudentInformation">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="tile">
                            <h3 class=" row justify-content-md-center">Grade point chart</h3>
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered" id="sampleTable">
                                    <thead>
                                        <tr>

                                            <th>Letter Grade</th>
                                            <th>Marks Interval</th>
                                            <th>Grade point</th>


                                        </tr>
                                    </thead>
                                    <tbody id="gradesInformation">
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-2">
                        <div class="tile">
                            <h3 class=" row justify-content-md-center">Image</h3>
                            {{-- <div class="table-responsive">
                                <table class="table table-hover table-bordered" id="sampleTable">
                                    <thead>
                                        <tr>

                                            <th>Payment Date</th>
                                            <th>Fee</th>
                                            <th>Type</th>
                                            <th>Total Amount</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div> --}}
                            <img src="https://www.gstatic.com/tv/thumb/persons/545659/545659_v9_bb.jpg" class="img-fluid" alt="">
                        </div>

                    </div>
                </div>
                <div class="row" id="resultDiv">
                    <div class="col-sm-12 ">
                        <div class="tile">
                            <h3 class=" row justify-content-md-center">Examination Result</h3>
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered" id="sampleTable">
                                    <thead>
                                        <tr>

                                            <th>Subject</th>
                                            <th>CA</th>
                                            <th>MCQ</th>
                                            <th>Written</th>
                                            <th>Practical</th>
                                            <th>Total</th>
                                            <th>Grade</th>
                                            <th>Point</th>

                                        </tr>
                                    </thead>
                                    <tbody  id="StudentInformation">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            </div>
        </div>



    <div class="clearix"></div>
    @endsection
    @section('script')
    @include('backend.partials.js.datatable');

    //script section
    <script>
        {{-- $('#informationDiv').attr('hidden',true);
        $('#resultDiv').attr('hidden',true); --}}


    $('.admission').change(function (e) {
        e.preventDefault();

        $('#informationDiv').attr('hidden',true);
        $('#resultDiv').attr('hidden',true);
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





        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            document.getElementById("doPrint").style.visibility = "hidden";
            //document.getElementById("more-result").style.visibility = "hidden";
            window.print();
            document.body.innerHTML = originalContents;
            //document.location.reload();
        }


//print button in table
$('#doPrint').on("click", function () {
    $('#print_div').printThis({
        debug: false,               // show the iframe for debugging
        importCSS: true,            // import parent page css
        importStyle: true,         // import style tags
        printContainer: true,       // print outer container/$.selector
        loadCSS: "",                // path to additional css file - use an array [] for multiple
        pageTitle: "",              // add title to print page
        removeInline: false,        // remove inline styles from print elements
        removeInlineSelector: "*",  // custom selectors to filter inline styles. removeInline must be true
        printDelay: 533,            // variable print delay
        header: null,               // prefix to html
        footer: null,               // postfix to html
        base: false,                // preserve the BASE tag or accept a string for the URL
        formValues: true,           // preserve input/form values
        canvas: false,              // copy canvas content
        doctypeString: '...',       // enter a different doctype for older markup
        removeScripts: false,       // remove script tags from print content
        copyTagClasses: false,      // copy classes from the html & body tag
        beforePrintEvent: null,     // function for printEvent in iframe
        beforePrint: null,          // function called before iframe is filled
        afterPrint: null            // function called before iframe is removed
    });
  });

    </script>
    @endsection
