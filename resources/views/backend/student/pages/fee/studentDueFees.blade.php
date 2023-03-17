@extends('backend.student.layouts.master')
	@section('title', 'Due fee page')
    @section('content')
    <div class="row ">
        <div class="col-md-3">
        <div class="tile p-0">

            <div class="form-group col pr-2" >
                <label for="exampleFormControlSelect1">Session Year</label>
                <select class="form-control admission" id="sessionYear">
                  <option value="">--Please Select--</option>
                  @foreach ($sessionYear as $year)
                    <option value="{{$year->id}}" {{$year->status == 1 ? 'selected': ''}}>{{$year->sessionYear}}</option>
                  @endforeach
                </select>
                <input type="text" name="month" id="classId" value="{{Auth::guard('student')->user()->Section->classes->id}}" class=" admission" hidden>
              </div>
        <div class="form-group col-md-3" id="tblFruits">
              <label class="control-label mt-3">Month</label><br>
                <div class="custom-control month-radio custom-control-inline">
                    <input type="radio" name="month" id="month1" value="JANUARY" class="custom-control-input admission">
                    <label class="custom-control-label attnchange"  for="month1">JANUARY</label>
                 </div>

                <div class="custom-control month-radio custom-control-inline">
                    <input type="radio" name="month" id="month2" value="FEBRUARY" class="custom-control-input admission">
                    <label class="custom-control-label attnchange" for="month2">FEBRUARY</label>
                </div>
                <div class="custom-control month-radio custom-control-inline">
                    <input type="radio" name="month" id="month3" value="MARCH" class="custom-control-input admission" >
                    <label class="custom-control-label attnchange" for="month3">MARCH</label>
                </div>

              <div class="custom-control month-radio custom-control-inline">
                    <input type="radio" name="month" id="month4" value="APRIL" class="custom-control-input admission">
                    <label class="custom-control-label attnchange"  for="month4">APRIL</label>
                 </div>
                <div class="custom-control month-radio custom-control-inline">
                    <input type="radio" name="month" id="month5" value="MAY" class="custom-control-input admission">
                    <label class="custom-control-label attnchange" for="month5">MAY</label>
                </div>
                <div class="custom-control month-radio custom-control-inline">
                    <input type="radio" name="month" id="month6" value="JUNE" class="custom-control-input admission">
                    <label class="custom-control-label attnchange" for="month6">JUNE</label>
                </div>

              <div class="custom-control month-radio custom-control-inline">
                    <input type="radio" name="month" id="month7" value="JULY" class="custom-control-input admission">
                    <label class="custom-control-label attnchange"  for="month7">JULY</label>
                 </div>
                <div class="custom-control month-radio custom-control-inline">
                    <input type="radio" name="month" id="month8" value="AUGUST" class="custom-control-input admission">
                    <label class="custom-control-label attnchange" for="month8">AUGUST</label>
                </div>
                <div class="custom-control month-radio custom-control-inline">
                    <input type="radio" name="month" id="month9" value="SEPTEMBER" class="custom-control-input admission">
                    <label class="custom-control-label attnchange" for="month9">SEPTEMBER</label>
                </div>

              <div class="custom-control month-radio custom-control-inline">
                    <input type="radio" name="month" id="month10" value="OCTOBER" class="custom-control-input admission">
                    <label class="custom-control-label attnchange"  for="month10">OCTOBER</label>
                 </div>
                <div class="custom-control month-radio custom-control-inline">
                    <input type="radio" name="month" id="month11" value="NOVEMBER" class="custom-control-input admission">
                    <label class="custom-control-label attnchange" for="month11">NOVEMBER</label>
                </div>
                <div class="custom-control month-radio custom-control-inline">
                    <input type="radio" name="month" id="month12" value="DECEMBER" class="custom-control-input admission">
                    <label class="custom-control-label attnchange" for="month12">DECEMBER</label>
                </div>
              </div>
	</p>
        </div>
        </div>
            <div class="col-md-9" id="print_div">
                <div class="tile">
                <input class="bg-warning text-dark" type='button'  value='Click To Print' id='doPrint'>
                <h3 id="unPaidDate" class=" row justify-content-md-center">Monthly Un-paid Fees</h3>
                    <div class="tile-body">
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
                    </div>
                    <br>
                    <h3 class=" row justify-content-md-center">Monthly Due Fees</h3>
                    <br>
                    <div class="tile-body">
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
                    </div>
                    <br>
                    <h3 class=" row justify-content-md-center">Yearly Un-paid Fees</h3>
                    <br>
                    <div class="tile-body">
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
                    </div>
                    <br>
                    <h3 class=" row justify-content-md-center">Yearly Due Fees</h3>
                    <br>
                    <div class="tile-body">
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
     <script src="{{ asset('admin/js/printThis.js') }} "></script>
       @include('backend.student.partials.js.datatable');

    <script src="{{ asset('admin/js/plugins/chart.js') }} "></script>
    <script type="text/javascript">

$(function(){
    $('.admission').change(function(){

      var month =$('input[type="radio"]:checked').val();
      var sessionYearId= $("#sessionYear option:selected").val()
      var classId=$('#classId').val();
      console.log(month,classId);
      $.ajax({
          type: "get",
          url: "{{url('student/due2/fee/show')}}"+"/"+month+"/"+sessionYearId+"/"+classId,
          success: function (response) {
              console.log(response);
              $('#unpaid').html(response.tableOut);
              $('#Totalunpaid').val(response.totalNotGiven);
              $('#due').html(response.dueFeeByMonth);
              $('#Totaldue').val(response.totalDueByMonth);
              $('#yearly_Un_paid').html(response.yearlyUnPaidHTML);
              $('#totalyearlyUnPaidFees').val(response.totalyearlyUnPaidFees);
              $('#yearly_du_fees').html(response.yearlyDueFees);
              $('#totalyearlyDuFees').val(response.totalDueByYear);
          }
      });



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


});
  </script>

@endsection
