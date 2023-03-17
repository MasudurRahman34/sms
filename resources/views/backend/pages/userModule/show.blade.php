@extends('backend.layouts.master')
	@section('title', 'Show user profile')
    @section('content')
    <div class="row user">
        <div class="col-md-3">
            <div class="card text-white bg-dark text-center" style="">
                <div class="card-content">
                    <div class="card-body">
                        @foreach($users->file as $fill)
                            @if($fill->type=="profile")
                                <img class="rounded mx-auto d-block" src="{{asset('users/'.$fill->image)}}" style="width: 50%; height: 50%;">
                            @endif
                        @endforeach
                        <hr>
                        <h5 class="text-info">{{$users->name}}</h5>
                        <h7 class="text-info">Designation : {{$users->designation}}</h7>
                    </div>
                </div>
            </div>
                <div class="tile p-0">
                  <ul class="nav flex-column nav-tabs user-tabs">
                  @if(Auth::guard('web')->user()->id=$editId)
                    <li class="nav-item"><a class="nav-link" href="{{route('userEditProfile', [$editId])}}"> Update Profile</a></li>
                  @endif
                    <li class="nav-item"><a class="nav-link" href="studentId2.html"> My school ID card</a></li>
                  </ul>
                </div>
              </div>

              <div class="col-md-9">
                <div class="">
                  <div class="tile">
                    <div class="tile-body">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs">
                          <li class="nav-item">
                            <a class="nav-link active" href="#profile">Profile</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="#payroll">Payroll</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="#leaves">Leaves</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="#attendence">Attendence</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="#documents">Documents</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="#timeline">Timeline</a>
                          </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                          <div id="profile" class="container tab-pane active"><br>
                            <div class="row">
                              <div class="col">
                                <ul class="list-group">
                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <strong> Name</strong>
                                    <p class="list-group justify-content-between align-items-center"> {{$users->name}} </p>
                                  </li>
                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Email
                                    <p class="list-group justify-content-between align-items-center"> {{$users->email}}  </p>
                                  </li>
                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Mobile
                                    <p class="list-group justify-content-between align-items-center"> {{$users->mobile}} </p>
                                  </li>
                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                   Join Date
                                    <p class="list-group justify-content-between align-items-center"> {{$users->joinDate}} </p>
                                  </li>
                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Address
                                    <p class="list-group justify-content-between align-items-center"> {{$users->address}} </p>
                                  </li>
                                </ul>
                              </div>
      
                              <div class="col">
                                <ul class="list-group">
                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                  Designation
                                    <p class="list-group justify-content-between align-items-center"> {{$users->designation}} </p>
                                  </li>
                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Skill
                                    <p class="list-group justify-content-between align-items-center"> {{$users->skill}} </p>
                                  </li>
                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Education
                                    <p class="list-group justify-content-between align-items-center"> {{$users->educattion}} </p>
                                  </li>
                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Biography
                                    <p class="list-group justify-content-between align-items-center"> {{$users->biography}} </p>
                                  </li>
                                </ul>
                              </div>
                            </div>
                          </div>
                      
                      <div id="payroll" class="container tab-pane fade"><br>
                        <div class="" id="print_div">
                          <div class="tile">
                            <div class="mailbox-controls">
                              <div class="row">
                                <div class="col-md-3">
                                  <div class="widget-small primary coloured-icon">
                                    <div class="info">
                                      <h4>Total Net Salary Paid</h4>
                                      <p><b>BDT20885</b></p>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div class="widget-small info coloured-icon">
                                    <div class="info">
                                      <h4>Total Gross Salary</h4>
                                      <p><b>BDT22000</b></p>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div class="widget-small warning coloured-icon">
                                    <div class="info">
                                      <h4>Total Earning</h4>
                                      <p><b>BDT22000</b></p>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div class="widget-small danger coloured-icon">
                                    <div class="info">
                                      <h4>Total Deduction</h4>
                                      <p><b>BDT1115</b></p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="btn-group">
                                <input class="bg-warning text-dark" type='button'  value='Click To Print' id='doPrint'>
                              </div>
                            </div>
                            <div class="table-responsive mailbox-messages">
                              <table class="table table-hover">
                                <thead>
                                  <tr role="row">
                                    <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">Payslip </th>
                                    <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">Month-Year</th>
                                    <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">Date</th>
                                    <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">Mode</th>
                                    <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">Status</th>
                                    <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">Net Salary(BDT)</th>
                                    <th class="text text-right sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">Result</th>
                                  </tr>
                              </thead>
                              <tbody>                                                            
                                <tr role="row" class="odd">
                                  <td tabindex="0" class="sorting_1">
                                      <a data-toggle="popover" href="#" class="detail_popover" data-original-title="" title="">3</a>
                                      <div class="fee_detail_popover" style="display: none">TEst</div>                          
                                  </td>
                                  <td>January - 2020</td>
                                  <td>01/01/1970</td>
                                  <td>Transfer to Bank Account</td>
                                  <td><span class="badge badge-pill badge-success">Paid</span></td>
                                  <td>10385</td>
                                  <td class="text-right">
                                    <a href="#" onclick="getPayslip('3')" role="button" class="btn btn-sm btn-primary checkbox-toggle edit_setting" type="button" data-toggle="tooltip" title="">View Payslip</a>
                                  </td>
                                </tr>
                                <tr role="row" class="even">
                                  <td tabindex="0" class="sorting_1">
                                      <a data-toggle="popover" href="#" class="detail_popover" data-original-title="" title="">1</a>
                                      <div class="fee_detail_popover" style="display: none">Test</div>                          
                                  </td>
                                  <td>December - 2020</td>
                                  <td>01/06/2020</td>
                                  <td>Cash</td>
                                  <td><span class="badge badge-pill badge-success">Paid</span></td>
                                  <td>10500</td>
                                  <td class="text-right">
                                    <a href="#" onclick="getPayslip('1')" role="button" class="btn btn-sm btn-primary checkbox-toggle edit_setting" data-toggle="tooltip" title="" data-original-title="">View Payslip</a>
                                  </td>
                                </tr>
                              </tbody>
                              </table>
                            </div>
                            <div class="text-right"><span class="text-muted mr-2">Showing 1-15 out of 60</span>
                              <div class="btn-group">
                                <button class="btn btn-primary btn-sm" type="button"><i class="fa fa-chevron-left"></i></button>
                                <button class="btn btn-primary btn-sm" type="button"><i class="fa fa-chevron-right"></i></button>
                              </div>
                            </div>
                          </div>        
                      </div>
                      </div>
      
                       <div id="leaves" class="container tab-pane fade"><br>
                        <div class="" id="print_div">
                          <div class="tile">
                            <div class="mailbox-controls">
                              <div class="row">
                                <div class="col-md-3">
                                  <div class="widget-small primary coloured-icon">
                                    <div class="info">
                                      <h4>Sick (10)</h4>
                                      <p><b>Used: 2</b></p>
                                      <p><b>Available: 8</b></p>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div class="widget-small info coloured-icon">
                                    <div class="info">
                                      <h4>Casual (12)</h4>
                                      <p><b>Used: 2</b></p>
                                      <p><b>Available: 8</b></p>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div class="widget-small warning coloured-icon">
                                    <div class="info">
                                      <h4>Annual (16)</h4>
                                      <p><b>Used: 2</b></p>
                                      <p><b>Available: 8</b></p>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div class="widget-small danger coloured-icon">
                                    <div class="info">
                                      <h4>Other Deduction</h4>
                                      <p><b>Used: 2</b></p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="btn-group">
                                <input class="bg-warning text-dark" type='button'  value='Click To Print' id='doPrint'>
                              </div>
                            </div>
                            <div class="table-responsive mailbox-messages">
                              <table class="table table-hover">
                                <thead>
                                  <tr role="row"><th class="sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 0px;" aria-label="Leave Type: activate to sort column ascending">Leave Type</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 0px;" aria-label="Leave Date: activate to sort column ascending">Leave Date</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 0px;" aria-label="Days: activate to sort column ascending">Days</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 0px;" aria-label="Apply Date: activate to sort column ascending">Apply Date</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 0px;" aria-label="Status: activate to sort column ascending">Status</th>
                                    <th class="text-right sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 0px;" aria-label="Action: activate to sort column ascending">Action</th>
                                  </tr>
                                </thead>
                                <tbody>         
                                  <tr role="row" class="odd">
                                    <td tabindex="0">Sick</td>
                                    <td>01/20/2020 - 01/20/2020</td>
                                    <td>1</td>
                                    <td>01/20/2020</td>
                                    <td><small style="text-transform: capitalize;" class="badge badge-pill badge-success">Approve</small></td>
                                    <td class="text-right"><a href="#leavedetails" onclick="getRecord('3')" role="button" class="btn btn-default btn-xs" data-toggle="tooltip" title="View"><i class="fa fa-eye"></i></a>
                                    </td>
                                  </tr>
                                  <tr role="row" class="even">
                                    <td tabindex="0">Sick</td>
                                    <td>01/06/2020 - 01/06/2020</td>
                                    <td>1</td>
                                    <td>01/06/2020</td>
                                    <td><small style="text-transform: capitalize;" class="badge badge-pill badge-success">Approve</small></td>
                                    <td class="text-right"><a href="#leavedetails" onclick="getRecord('2')" role="button" class="btn btn-default btn-xs" data-toggle="tooltip" title="View"><i class="fa fa-eye"></i></a>  </td>
                                  </tr></tbody>
                              </table>
                            </div>
                            <div class="text-right"><span class="text-muted mr-2">Showing 1-15 out of 60</span>
                              <div class="btn-group">
                                <button class="btn btn-primary btn-sm" type="button"><i class="fa fa-chevron-left"></i></button>
                                <button class="btn btn-primary btn-sm" type="button"><i class="fa fa-chevron-right"></i></button>
                              </div>
                            </div>
                          </div>        
                        </div>
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
      {{-- @include('backend.partials.js.datatable'); --}}
      <script>
      //   $(document).ready(function(){
      //   $(".nav-tabs a").click(function(){
      //     $(this).tab('show');
      //   });
      // });

      //   function readURL(input) {
      //       if (input.files && input.files[0]) {
      //           var reader = new FileReader();
      //           reader.onload = function(e) {
      //               $('#image_preview').attr('src', e.target.result);
      //           }
      //           reader.readAsDataURL(input.files[0]);
      //       }
      //   }
      //   $("#image").change(function() {
      //       readURL(this);
      //   });
      $(document).ready(function(){
        $(".nav-tabs a").click(function(){
          $(this).tab('show');
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
    </script>
  @endsection
