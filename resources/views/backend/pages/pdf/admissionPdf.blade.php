@extends('backend.layouts.master')
	@section('title', 'Class Management')
        @section('content')


      <div class="app-title">
        <div>
          <h1><i class="fa fa-file-text-o"></i> Student Admission Invoice</h1>

        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">{{$students->schoolBranch->nameOfTheInstitution}}</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
          <a id='doPrint' class="btn btn-light float-right"><i class="fa fa-print"></i> Print</a>
          <a class="float-right btn btn-primary" href="{{route('admissison.index')}}"><i class="fa fa-plus-circle"></i>New Admission</a>

            <section class="invoice m-4" id="print_div">
              <div class="row">
                <div class="col-6">
                  <h2 style="color: black;" class="page-header text-drak"><i class="fa fa-graduation-cap"></i>  {{$students->schoolBranch->nameOfTheInstitution}}</h2>
                </div>
                <div class="col-4">

                </div>
                <div class="col-2">
                    <h5 class="text-right">Date: {{date("Y-m-d")}}</h5>
                </div>
              </div>
              <div class="row invoice-info">
                <div class="col-4">From
                  <address><strong>{{Auth::guard('web')->user()->name}}</strong><br><br></address>
                </div>
                <div class="col-4">To
                  <address><strong>{{$students->firstName }} {{$students->lastName}}</strong><br>Class: {{$students->Section->classes->className}} ({{$students->group}})<br>Roll: {{$students->roll}}<br>Section: {{$students->Section->sectionName}}<br>Session: {{$students->Section->sessionYear->sessionYear}}<br>Blood Group: {{$students->blood}}</address>
                </div>
                <div class="col-4">Student ID: {{$students->studentId }}<br>Mobile: {{$students->mobile}}<br>Password: {{$students->readablePassword}}<br><b>Type : {{$students->type}}</b><br>Scholarship: @if($students->schoolarshipId==0)
                    {{'No'}}
                @else
                @foreach($students->studentScholarship as $scholarship) {{$scholarship->scholarship->name}} {{$scholarship->discount}}% on {{$scholarship->Fee->name}} @endforeach
                @endif</b><br><h4 class="pt-2">Paid Amount: <b> {{$students->feeCollection->sum('totalAmount')}} Taka Only
              </div>
              </div>
              <div class="row">
                <div class="col-12 table-responsive">
                  <table id="customers" class="table table-bordered">
                    <thead>
                      <tr style="">
                        <th>Fee Name</th>
                        <th>Paid Month</th>
                        <th>Amount</th>
                        <th>Due</th>
                        <th>Total Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($students->feeCollection as $feeCollection)
                      <tr>
                        <td>{{$feeCollection->Fee->name}}</td>
                        <td>{{$feeCollection->paidMonth}}</td>
                        <td>{{$feeCollection->amount}}</td>
                        <td>{{$feeCollection->due}}</td>
                        <td>{{$feeCollection->totalAmount}}</td>
                      </tr>
                    @endforeach
                    </tbody>
                  </table>
                  <h3 class="text-center m-5">Thank You For Your Admission<br></h3>
                    <a class="mx-auto" href="http://www.sms.quadinfoltd.com/">www.sms.quadinfoltd.com</a>
                </div>
              </div>

            </section>
          </div>
        </div>
      </div>
        @endsection
    @section('script')
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
