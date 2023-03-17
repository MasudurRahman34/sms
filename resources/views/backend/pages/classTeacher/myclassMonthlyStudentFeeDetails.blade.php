@extends('backend.layouts.master')
	@section('title', 'Admin|| Student Fee Details')
    @section('content')
    <div class="app-title">
        <div>
          <h1><i class="fa fa-edit"></i>Student Individual Fee Detail's </h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Home</li>
          <li class="breadcrumb-item"><a href="#">Individual Student Fee Detail's</a></li>
        </ul>
    </div>
    @include('backend.partials._message')
    <style>
        @media print{
            .table-bordered{
            background-color: green;
        }
    }
    </style>
<div class="row justify-content-md-center">
    <div class="clearix"></div>
        <div class="col-md-9">
            <div class="tile">
                <div class="tile-body">
                <div class="row">
                    <div class="form-group col-md-5 pr-2" >
                        <label for="exampleFormControlSelect1"> Month</label>
                        {{-- <input class="form-control " id="month" type="month" placeholder="Pick a month" value="{{date('Y-m')}}"/> --}}
                        <select class="form-control " id="month">
                            <option value="">--Select Fee--</option>
                            <option value="JANUARY">JANUARY</option>
                            <option value="FEBRUARY">FEBRUARY</option>
                            <option value="MARCH">MARCH</option>
                            <option value="APRIL">APRIL</option>
                            <option value="MAY">MAY</option>
                            <option value="JUNE">JUNE</option>
                            <option value="JULY">JULY</option>
                            <option value="AUGUST">AUGUST</option>
                            <option value="SEPTEMBER">SEPTEMBER</option>
                            <option value="OCTOBER">OCTOBER</option>
                            <option value="NOVEMBER">NOVEMBER</option>
                            <option value="DECEMBER">DECEMBER</option>
                    </select>
                    </div>
                    <div class="form-group col-md-5">
                        <label for="exampleFormControlSelect1"> Student Name</label>
                        <select class="form-control " id="studentId">
                            <option value=""> --Please Select--  </option>
                        </select>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="clearix"></div>

<div class="row justify-content-md-center" id="print_div">
    <div class="col-md-9 ">
       <div class="tile">
            <input class="bg-warning text-dark float-right" type='button'  value='Print' id='doPrint'>
            <h3 class=" row justify-content-md-center">Monthly Paied Fees Details</h3>
            <div class="table-responsive">
                <table class="table table-hover table-bordered" id="sampleTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Payment Date</th>
                            <th>Fee</th>
                            <th>Type</th>
                            <th>Total Amount</th>

                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <div class=" form-inline float-right">
                    <lebel class="text-success" for="Total">Total = </lebel><input type="text" class="form-control" id="TotalPaied" readonly/>
                </div>
            </div>
            <br>
            <h3 id="unPaidDate" class=" row justify-content-md-center">Monthly Un-paid Fees</h3>
            <div class="table-responsive">
                <table class="table table-hover table-bordered" id="sampleTable">
                    <thead>
                        <tr>
                            <th>Fee</th>
                            <th>Amount</th>
                        </tr>

                    </thead>
                    <tbody id="unpaid">
                    </tbody>
                </table>
                <div class=" form-inline float-right">
                    <lebel class="text-success" for="Total">Total = </lebel><input type="text" class="form-control" id="Totalunpaid" readonly/>
                </div>
            </div>
            <br>
            <h3 class=" row justify-content-md-center">Monthly Due Fees</h3>
            <div class="table-responsive">
                <table class="table table-hover table-bordered" id="sampleTable">
                    <thead>
                        <tr>
                            <th>Fee</th>
                            <th>Amount</th>
                            <th>Total Amount</th>
                            <th>Due</th>
                        </tr>

                    </thead>
                    <tbody id="due">

                    </tbody>
                </table>
                <div class=" form-inline float-right">
                    <lebel class="text-success" for="Total">Total = </lebel><input type="text" class="form-control" id="Totaldue" readonly/>
                </div>
            </div>
            <br>
            <h3 class=" row justify-content-md-center">Yearly Un-paid Fees</h3>
            <div class="table-responsive">
                <table class="table table-hover table-bordered" id="sampleTable">
                    <thead>
                        <tr>
                            <th>Fee</th>
                            <th>Amount</th>
                        </tr>

                    </thead>
                    <tbody id="yearly_Un_paid">

                    </tbody>
                </table>
                <div class=" form-inline float-right">
                    <lebel class="text-success" for="Total">Total = </lebel><input type="text" class="form-control" id="totalyearlyUnPaidFees" readonly/>
                </div>
            </div>
            <br>
            <h3 class=" row justify-content-md-center">Yearly Due Fees</h3>
            <div class="table-responsive">
                <table class="table table-hover table-bordered" id="sampleTable">
                    <thead>
                        <tr>
                            <th>Fee</th>
                            <th>Amount</th>
                            <th>Total Amount</th>
                                <th>Due</th>
                        </tr>

                    </thead>
                    <tbody id="yearly_du_fees">

                    </tbody>
                </table>
                <div class=" form-inline float-right">
                    <lebel class="text-success" for="Total">Total = </lebel><input type="text" class="form-control" id="totalyearlyDuFees" readonly/>
                </div>
            </div>
        </div>
    </div>
  </div>
    <div class="clearix"></div>
    @endsection
    @section('script')
    {{-- <script src="{{ asset('admin/js/printThis.js') }} "></script> --}}
    <script>

//on change section for find student
    $('#month').change(function (e) {
        e.preventDefault();
        var sectionId={{$sectionId}};
        //console.log(sectionId);
        $.ajax({
          type: "get",
          url: "{{ url('feecollection/individualStudentDetails')}}",
          data: {
            sectionId:sectionId
          },
          success: function (data) {
            //change start from here
            //console.log(data);
            var option="<option>--Please Select--</option>";
            data.forEach(element => {
                option+=("<option value='"+element.id+"'>"+element.firstName+' '+element.lastName+'('+element.studentId+')'+"</option>");
                });
                $('#studentId').html(option);
                }
        });
    });


//on change section for find student
$('#studentId').change(function (e) {
    e.preventDefault();
    var month=$("#month").val();
    var studentId=$(this).val();
    var sessionYearId={{$sessionYearId}};
    var classId={{$classId}};
    // show fee details information
    //console.log(month,sessionYearId,classId,studentId);
    if(month!== null && month !== '' && studentId>0){
        $.ajax({
            type: "get",
            url: "{{url('feecollection/details/show')}}"+"/"+month+"/"+studentId+"/"+sessionYearId+"/"+classId,

            success: function (response) {
                  //console.log(response);
                  $('tbody').html(response.tableOutPut);
                  $('#TotalPaied').val(response.totalAmountPay+ "/=");
                  $('#unpaid').html(response.tableOut);
                  $('#Totalunpaid').val(response.totalNotGiven+ "/=");
                  $('#due').html(response.dueFeeByMonth);
                  $('#Totaldue').val(response.totalDueByMonth+ "/=");
                  $('#yearly_Un_paid').html(response.yearlyUnPaidHTML);
                  $('#totalyearlyUnPaidFees').val(response.totalyearlyUnPaidFees+ "/=");
                  $('#yearly_du_fees').html(response.yearlyDueFees);
                  $('#totalyearlyDuFees').val(response.totalDueByYear+ "/=");

              }

            });

    }


});


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


