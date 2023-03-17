@extends('backend.layouts.master')
	@section('title', 'Date Wise Income Expanse Report')
    @section('content')
    <div class="app-title">
        <div>
          <h1><i class="fa fa-edit"></i>Date Wise Income Expense Report</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Income Expanse Report</a></li>
        </ul>
    </div>
    @include('backend.partials._message')
    <style>
        @media print{
            .table-bordered{
               background-color: green;
             }
          }
          hr.new2 {
            border-top: 1px dashed red;
          }
          hr.new3 {
            border-top: 1px dotted red;
          }
    </style>
<div class="tile mb-4">
    <div class="row">
      <div class="col-lg-12">
        <div class="table-responsive"  id="print_div">
        <div class="row">
            <div class="col-lg-2">
              <div class="bs-component">
                <div class="list-group">
                  <img src="https://img.icons8.com/color/96/000000/motarboard.png"/>
                </div>
              </div>
            </div>
            <div class="col-lg-8">
              <div class="bs-component">
                <div class="list-group">
                    <h2 class="text-warning">Foridpur Girls & Boys Pilot High School.</h2>
                    <h5>House:77, Level 2 & 3, Road: 08, Block A, Dhanmondi 9/A, Dhaka-1207 sed diam eget risus varius blandit sit amet non magna.</h5>
                </div>
              </div>
            </div>
            <div class="col-lg-2">
              <div class="bs-component">
                <input type='button' class="bg-warning text-dark float-right"  value=' Print ' id='doPrint'>
                 <div class="list-group">
                    <h6 ><i class="fa fa-phone-square" aria-hidden="true"></i> +8801885 986814</h6>
                    <h6 ><i class="fa fa-phone-square" aria-hidden="true"></i> +8801885 986814</h6>
                    <h6 ><i class="fa fa-envelope-o" aria-hidden="true"></i> quadinfo@gmail.com</h6>
                  </div>
              </div>
            </div>
      </div><hr class="new2">
      <div class="col-lg-12">
        <div class="bs-component">
          <div class="list-group">
            <h4 class="text-center text-info">Date Wise Income & Expense Statement Report</h4><hr class="new3" align="center" width="30%">
            <p class="text-center">01-1-2020 To 15-01-2020</p>
          </div>
        </div>
        <br>
        <div class="col-md-12">
          <div class="tile">
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead class="thead-light">
                  <tr>
                    <th>Serial</th>
                    <th>Date</th>
                    <th>Income</th>
                    <th>Expense</th>
                    <th>Total Balance</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>01-01-2020</td>
                    <td>460</td>
                    <td>200</td>
                    <td>240</td>
                  </tr>
                  <tr>
                    <td>1</td>
                    <td>01-01-2020</td>
                    <td>460</td>
                    <td>200</td>
                    <td>240</td>
                  </tr>
                  <tr>
                    <td>1</td>
                    <td>01-01-2020</td>
                    <td>460</td>
                    <td>200</td>
                    <td>240</td>
                  </tr>
                  <tr>
                    <td>1</td>
                    <td>01-01-2020</td>
                    <td>460</td>
                    <td>460</td>
                    <td>200</td>
                  </tr>
                  <tr>
                    <td>1</td>
                    <td>01-01-2020</td>
                    <td>460</td>
                    <td>200</td>
                    <td>240</td>
                  </tr>
                  <tr>
                    <td>1</td>
                    <td>01-01-2020</td>
                    <td>460</td>
                    <td>200</td>
                    <td>240</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
    </div>
  </div>
  </div>
<div class="clearix"></div>

    @endsection
    @section('script')
    <script src="{{ asset('admin/js/printThis.js') }} "></script>
    <script>

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

