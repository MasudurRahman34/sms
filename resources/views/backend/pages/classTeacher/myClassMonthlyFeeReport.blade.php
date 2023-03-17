@extends('backend.layouts.master')
	@section('title', 'Fee Management Report')
    @section('content')
    {{-- //main content --}}
    <div class="app-title">
        <div class="hmmm">
          <h1><i class="fa fa-edit"></i>Fee Management Report</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Home / Admin</li>
          <li class="breadcrumb-item"><a href="#">Report</a></li>
        </ul>
    </div>
    {{-- section --}}
        <div class="row justify-content-md-center">
            <div class="clearix"></div>
                <div class="col-md-9">
                    <div class="tile">
                        <div class="tile-body">
                        <div class="row">
                            <div class="form-group col">
                                <label for="exampleFormControlSelect1"> Session Year</label>
                                    <select class="form-control " id="sessionYear" >
                                        <option value="">--Please Select--</option>
                                        @foreach ($sessionYear as $year)
                                            <option value="{{$year->id}}" {{$year->status == 1 ? 'selected': ''}}>{{$year->sessionYear}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            <div class="form-group col-md-4 pr-2" >
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
                        </div>
                        </div>
                    </div>
                </div>

                <div class="clearix"></div>
                <div class="col-md-9">
                    <div class="tile">
                    <div class="tile-body">
                        <input class="bg-warning text-dark float-right" type='button'  value=' Print ' id='doPrint'>
                        <input id="myInput" type="text" placeholder="Search.."><hr>
                        <div id="print_div" class="print_div">
                            <h3 class="tile-title">Section Wise Monthly Report </h3>
                                <div class="table-responsive">
                                <table class="table table-hover table-bordered" id="sampleTable">
                                <thead>
                                    <tr>
                                    <th>Sl</th>
                                    <th>Class</th>
                                    <th>Section</th>
                                    <th>Shift</th>
                                    <th>Government Fees Total</th>
                                    <th>Non-Government Fees Total</th>
                                    <th>Total Fee</th>
                                    <th>Due</th>
                                    {{-- <th>Due collection</th>
                                    <th>Total Collection</th> --}}

                                    </tr>
                                </thead>
                                <tbody class="sectionTotal" id="sectionwisereport">
                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <div class="clearix"></div>

                <div class="col-md-9">
                    <div class="tile">
                    <div class="tile-body">
                        {{-- <input class="bg-warning text-dark float-right" type='button'  value=' Print ' id='doPrint'> --}}
                        <div id="print_div" class="print_div">
                            <h3 class="tile-title "> Government Fee Type Report </h3>
                                <div class="table-responsive">
                                <table class="table table-hover table-bordered" id="sampleTable">
                                    <thead>
                                        <tr>
                                            <th >Sl</th>
                                            <th>Class</th>
                                            {{--  <th style="width:2%;height:1%;" rowspan="2">Roll</th>  --}}
                                            <th style="width:12%;height:1%;" rowspan="2" >Section</th>
                                            <th>Shift</th>
                                            {{--  <th rowspan="1" colspan="2">Fee Amount</th>  --}}
                                            <th rowspan="1">Fee Title</th>
                                            <th rowspan="1">Sub Total </th>
                                            <th>Due</th>
                                            <th rowspan="" colspan="">Total Number Student</th>
                                            <th rowspan="" colspan="">Details</th>
                                        </tr>
                                        {{--  <tr>
                                            <th rowspan="1">Fee D</th>
                                            <th rowspan="1">T</th>
                                        </tr>  --}}
                                    </thead>
                                <tbody class="sectionTotal" id="government">
                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                </div>

                <div class="clearix"></div>

                <div class="col-md-9">
                    <div class="tile">
                    <div class="tile-body">
                        {{-- <input class="bg-warning text-dark float-right" type='button'  value=' Print ' id='doPrint'> --}}
                        <div id="print_div" class="print_div">
                            <h3 class="tile-title"> Non-Government Fee Type Report </h3>
                                <div class="table-responsive">
                                <table class="table table-hover table-bordered" id="sampleTable">
                                    <thead>
                                        <tr>
                                            <th>Sl</th>
                                            <th>Class</th>
                                            {{--  <th style="width:2%;height:1%;" rowspan="2">Roll</th>  --}}
                                            <th style="width:12%;height:1%;" rowspan="2" >Section</th>
                                            <th>Shift</th>
                                            {{--  <th rowspan="1" colspan="2">Fee Amount</th>  --}}
                                            <th rowspan="1">Fee Title</th>
                                            <th rowspan="1">Sub Total </th>
                                            <th>Due</th>
                                            <th rowspan="1" colspan="1">Total Number Student</th>
                                            <th rowspan="" colspan="">Details</th>
                                        </tr>
                                        {{--  <tr>
                                            <th rowspan="1">Fee D</th>
                                            <th rowspan="1">T</th>
                                        </tr>  --}}
                                    </thead>
                                <tbody class="sectionTotal" id="nongovt">
                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                </div>

                <div class="clearix"></div>

                <div class="col-md-9">
                    <div class="tile">
                    <div class="tile-body">
                        {{-- <input class="bg-warning text-dark float-right" type='button'  value=' Print ' id='doPrint'> --}}
                        <div id="print_div" class="print_div">
                            <h3 class="tile-title"> Due Fee Collection Report </h3>
                                <div class="table-responsive">
                                <table class="table table-hover table-bordered" id="sampleTable">
                                    <thead>
                                        <tr>
                                            <th>Sl</th>
                                            <th>Class</th>
                                            {{--  <th style="width:2%;height:1%;" rowspan="2">Roll</th>  --}}
                                            <th style="width:12%;height:1%;" rowspan="2" >Section</th>
                                            <th>Shift</th>
                                            {{--  <th rowspan="1" colspan="2">Fee Amount</th>  --}}
                                            <th rowspan="1">Fee Title</th>
                                            <th rowspan="1">Sub Total </th>
                                            <th rowspan="2" colspan="1">Number of Student</th>
                                            <th rowspan="2" colspan="1">Fee month</th>
                                            <th rowspan="2" colspan="1">Paid Month</th>
                                        </tr>
                                        {{--  <tr>
                                            <th rowspan="1">Fee D</th>
                                            <th rowspan="1">T</th>
                                        </tr>  --}}
                                    </thead>
                                <tbody class="sectionTotal" id="dueFee">
                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <div class="clearix"></div>
                <div class="col-md-9">
                    <div class="tile">
                    <div class="tile-body">
                        {{-- <input class="bg-warning text-dark float-right" type='button'  value=' Print ' id='doPrint'> --}}
                        <div id="print_div" class="print_div">
                            {{-- <h3 class="tile-title"> Due Fee Collection Report </h3> --}}
                                <div class="" id="f" hidden>
                                    <br><br><br>
                                    <p>................................................</p>
                                    <p>Signature & Date</p>

                            </div>
                        </div>
                    </div>
                </div>
                </div>



    </div>
    {{-- End section --}}
</div>

{{-- End Section --}}
<div class="clearix"></div>

<div class="clearix"></div>
    <!-- The Modal -->
    <div class="modal" id="newModal" >
      <div class="modal-dialog modal-lg ">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Fee Details</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <div class="col-md">
                <div class="tile">
                <div class="tile-body">

                    {{-- <input class="bg-warning text-dark float-right" type='button'  value=' Print ' id='doPrint'> --}}
                    <div id="print_div2" class="print_div2">
                        <h3 class="tile-title"> Student Fee Collection Report </h3>
                            <div class="table-responsive">
                            <table class="table table-hover table-bordered" id="sampleTable">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Student Id</th>
                                        <th>Name</th>
                                        <th>Roll</th>
                                        <th>Class</th>
                                        {{--  <th style="width:2%;height:1%;" rowspan="2">Roll</th>  --}}
                                        {{--  <th style="width:12%;height:1%;" rowspan="2" >Section</th>
                                        <th>Shift</th>  --}}
                                        {{--  <th rowspan="1" colspan="2">Fee Amount</th>  --}}
                                        <th rowspan="1">Fee Title</th>
                                        <th rowspan="1">Paid Amount</th>


                                        <th rowspan="2" colspan="1">Fee month</th>
                                        <th rowspan="2" colspan="1">Paid Month</th>
                                    </tr>
                                    {{--  <tr>
                                        <th rowspan="1">Fee D</th>
                                        <th rowspan="1">T</th>
                                    </tr>  --}}
                                </thead>
                            <tbody class="sectionTotal" id="feedetails">
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            </div>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            {{--  <button id="btnPrint" type="button" class="btn btn-default">Print</button>  --}}
            <button type="button" class="btn btn-primary" id="yes" data-dismiss="modal"> Yes </button>
            <button type="button" class="btn btn-danger" id="cancel" data-dismiss="modal">Close</button>
          </div>

        </div>
      </div>
    </div>
    @endsection
    @section('script')
      @include('backend.partials.js.datatable');

    //script section
    <script>
$('#month').change(function(e){
    e.preventDefault();

    var month =$('#month').val();
    var sessionYearId =$('#sessionYear').val();
    var sectionId={{$sectionId}};

    console.log(month,sessionYearId,sectionId);

    //alert('working');
    $.ajax({
        type: "get",
        url:"{{ url('myclass/monthly/feereport/show')}}"+'/'+month+'/'+sessionYearId+'/'+sectionId,
        success: function (data) {

            console.log(data.sectionTotalTableOutput);
            console.log(data.governmentFeeTableOutput);
            console.log(data.nonGovtFeeTableOutput);
            console.log(data.dueFeeTotalsdata);


            $('#sectionwisereport').html(data.sectionTotalTableOutput);
            $('#government').html(data.governmentFeeTableOutput);
            $('#nongovt').html(data.nonGovtFeeTableOutput);
            $('#dueFee').html(data.dueFeeTotalsdata);
        }
    });



});

$("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $(".sectionTotal tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });

function show(){
    $('#f').attr('hidden',false);
}
function hide(){
    $('#f').attr('hidden',true);
}

function details(sectionId,classId,feeId){

    var month =$('#month').val();
    var sessionYearId =$('#sessionYear').val();

    console.log(sectionId,feeId,classId,month,sessionYearId);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        },
    });

    $.ajax({
        type: "post",
        url:"{{ url('feemanagement/report/sectionwise/feedetails')}}",
        data: {
            sectionId:sectionId,
            feeId:feeId,
            sessionYearId: sessionYearId,
            month: month,
            classId: classId,
          },
        success: function (data) {
         console.log(data.feedetaildata);
         $("#newModal").modal("show");
        {{--  $("#yes").click(function(e){
            alert("Thank You");

        });  --}}
         $('#feedetails').html(data.feedetaildata);


        }
    });

};
{{--  $("#btnPrint").onclick = function () {
    printElement(document.getElementById("printThis"));
}

function printElement(elem) {
    var domClone = elem.cloneNode(true);

    var $printSection = document.getElementById("printSection");

    if (!$printSection) {
        var $printSection = document.createElement("div");
        $printSection.id = "printSection";
        document.body.appendChild($printSection);
    }

    $printSection.innerHTML = "";
    $printSection.appendChild(domClone);
    window.print();
}  --}}

//print button in table
$('#doPrint').on("click", function () {
    $('.print_div').printThis({
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
        beforePrint: show,          // function called before iframe is filled
        afterPrint: hide,            // function called before iframe is removed
    });
  });

    </script>
    @endsection
