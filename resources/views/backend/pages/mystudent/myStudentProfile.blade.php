@extends('backend.layouts.master')
	@section('title', 'Studenty profile Page')
    @section('content')
            <div class="row user">
              <div class="col-md-3">
                <div class="card text-white bg-dark text-center" style="">
                  <div class="card-content">
                      <div class="card-body">
                          @foreach($students->files as $file)
                              @if($file->type=="profile")
                                  <img class="rounded mx-auto d-block" src="{{asset('students/'.$file->image)}}" style="width: 50%; height: 50%;">
                              @endif
                          @endforeach
                          <hr>
                          <h5>{{$students->firstName}}</h5>
                          <h7 class="text-info">Class : {{$students->Section->classes->className}}</h7>
                          <p class="text-info">{{$students->schoolBranch->nameOfTheInstitution}}</p>
                      </div>
                  </div>
              </div>
                <div class="tile p-0">
                  <ul class="nav flex-column nav-tabs user-tabs">
                    <li class="nav-item"><a class="nav-link active" href="#user-timeline" data-toggle="tab">Timeline</a></li>

                    <li class="nav-item"><a class="nav-link" href="{{route('mystudent.editProfile', $students->id)}}"> Update Profile</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('mystudent.subjectlist', $students->id)}}">Subject List</a></li>
                    <li class="nav-item"><a class="nav-link" id="Attendance"> Attendance</a></li>
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
                            <a class="nav-link" href="#exam">Exam</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="#document">Documents</a>
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
                                    <p class="list-group justify-content-between align-items-center"> {{$students->firstName}} </p>
                                  </li>
                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Father name
                                    <p class="list-group justify-content-between align-items-center">  {{$students->fatherName}} </p>
                                  </li>
                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Mother Name
                                    <p class="list-group justify-content-between align-items-center"> {{$students->motherName}} </p>
                                  </li>
                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                  Session Year
                                    <p class="list-group justify-content-between align-items-center"> {{$students->Section->SessionYear->sessionYear}} </p>
                                  </li>
                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Location
                                    <p class="list-group justify-content-between align-items-center"> {{$students->address}} </p>
                                  </li>
                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Phone
                                    <p class="list-group justify-content-between align-items-center"> {{$students->mobile}} </p>
                                  </li>
                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Date of Birth
                                    <p class="list-group justify-content-between align-items-center"> {{$students->birthDate}} </p>
                                  </li>
                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Blood Grop
                                    <p class="list-group justify-content-between align-items-center"> {{$students->blood}} </p>
                                  </li>
      
                                </ul>
                              </div>
                              <div class="col">
                                <ul class="list-group">
                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Class
                                    <p class="list-group justify-content-between align-items-center"> {{$students->Section->classes->className}} </p>
                                  </li>
                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Section
                                    <p class="list-group justify-content-between align-items-center"> {{$students->Section->sectionName}} </p>
                                  </li>
                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Shift
                                    <p class="list-group justify-content-between align-items-center"> {{$students->Section->shift}} </p>
                                  </li>
                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Group
                                    <p class="list-group justify-content-between align-items-center">  {{$students->group}}</p>
                                  </li>
                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Roll Number
                                    <p class="list-group justify-content-between align-items-center"> {{$students->roll}}  </p>
                                  </li>
                                </ul>
                              </div>
                              <div class="col">
                                <ul class="list-group">
                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Father name
                                    <p class="list-group justify-content-between align-items-center">  {{$students->fatherName}} </p>
                                  </li>
                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Mother Name
                                    <p class="list-group justify-content-between align-items-center"> {{$students->motherName}} </p>
                                  </li>
                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Father occopation
                                    <p class="list-group justify-content-between align-items-center">{{$students->fatherOccupation}}</p>
                                  </li>
                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Mother occopation
                                    <p class="list-group justify-content-between align-items-center"> {{$students->MotherOccupation}}</p>
                                  </li>
                                </ul>
                              </div>
                            </div>
                          </div>
                      
                      <div id="exam" class="container tab-pane fade"><br>
                        <div class="" id="print_div">
                          <div class="tile">
                            <div class="mailbox-controls">
                              <div class="animated-checkbox">
                                <label>
                                  <input type="checkbox"><span class="label-text text-warning">1st Tearm Exam</span>
                                </label>
                              </div>
                              <div class="btn-group">
                                <input class="bg-warning text-dark" type='button'  value='Click To Print' id='doPrint'>
                              </div>
                            </div>
                            <div class="table-responsive mailbox-messages">
                              <table class="table table-hover">
                                <thead>
                                  <tr role="row">
                                    <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">Subject </th>
                                    <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">Full Marks</th>
                                    <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">Passing Marks</th>
                                    <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">Obtain Marks</th>
                                    <th class="text text-right sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">Result</th>
                                  </tr>
                              </thead>
                              <tbody>
                                <tr role="row" class="odd">
                                  <td tabindex="0">  Bangla 1st Paper (Th.) </td>
                                  <td>100</td>
                                  <td>33</td>
                                  <td>79.00</td>
                                  <td class="text text-center"><span class="label pull-right bg-green">Pass</span></td>
                                </tr>
                                <tr role="row" class="even">
                                  <td tabindex="0">  Bangla 2nd Paper (Th.) </td>
                                  <td>100</td>
                                  <td>33</td>
                                  <td>89.00</td>
                                  <td class="text text-center"><span class="label pull-right bg-green">Pass</span></td>
                                </tr>
                                <tr role="row" class="odd">
                                  <td tabindex="0">  English 1st Paper (Th.) </td>
                                  <td>100</td>
                                  <td>33</td>
                                  <td>98.00 </td>
                                  <td class="text text-center"><span class="label pull-right bg-green">Pass</span></td>
                                </tr>
                                <tr role="row" class="even">
                                  <td tabindex="0">  English 2nd Paper (Th.) </td>
                                  <td>100</td>
                                  <td>33</td>
                                  <td>95.00</td>
                                  <td class="text text-center"><span class="label pull-right bg-green">Pass</span></td>
                                </tr>
                                <tr role="row" class="odd">
                                  <td tabindex="0">  Math (Th.) </td>
                                  <td>100</td>
                                  <td>33</td>
                                  <td>100.00</td>
                                  <td class="text text-center"><span class="label pull-right bg-green">Pass</span></td>
                                </tr>
                                <tr role="row" class="even">
                                  <td tabindex="0">  Information &amp; Technology (Th.) </td>
                                  <td>100</td>
                                  <td>33</td>
                                  <td>96.00</td>
                                  <td class="text text-center"><span class="label pull-right bg-green">Pass</span></td>
                                </tr>
                                <tr role="row" class="odd">
                                  <td tabindex="0">  Physics (Th.) </td>
                                  <td>100</td>
                                  <td>33</td>
                                  <td>ABS</td>
                                  <td class="text text-center"><span class="label pull-right text-danger">Fail</span> </td>
                                </tr>
                                <tr role="row" class="even">
                                  <td tabindex="0">  Chemistry (Th.) </td>
                                  <td>100</td>
                                  <td>33</td>
                                  <td>ABS</td>
                                  <td class="text text-center"><span class="label pull-right text-danger">Fail</span></td>
                                </tr>
                                <tr role="row" class="odd">
                                  <td tabindex="0">  Biology (Th.) </td>
                                  <td>100</td>
                                  <td>33</td>
                                  <td>ABS</td>
                                  <td class="text text-center"><span class="label pull-right text-danger">Fail</span></td>
                               </tr>
                               <tr role="row" class="even">
                                  <td tabindex="0">  Science (Th.) </td>
                                  <td>100</td>
                                  <td>33</td>
                                  <td>85.00 </td>
                                  <td class="text text-center"><span class="label pull-right bg-green">Pass</span> </td>
                              </tr><tr role="row" class="odd">
                                  <td tabindex="0">  Accounting (Th.) </td>
                                  <td>100</td>
                                  <td>33</td>
                                  <td>100.00</td>
                                  <td class="text text-center"><span class="label pull-right bg-green">Pass</span></td>
                              </tr><tr role="row" class="even">
                                  <td tabindex="0">  Finance &amp; Banking (Th.) </td>
                                  <td>100</td>
                                  <td>33</td>
                                  <td>72.00</td>
                                  <td class="text text-center"><span class="label pull-right bg-green">Pass</span></td>
                              </tr><tr role="row" class="odd">
                                  <td tabindex="0">  Business &amp; Entrepreneurship (Th.) </td>
                                  <td>100</td>
                                  <td>33</td>
                                  <td>33.00</td>
                              <td class="text text-center"><span class="label pull-right bg-green">Pass</span> </td>
                            </tr><tr role="row" class="even">
                                  <td tabindex="0">  Economics (Th.) </td>
                                  <td>100</td>
                                  <td>33</td>
                                  <td>90.00 </td>
                                  <td class="text text-center"><span class="label pull-right bg-green">Pass</span> </td>
                           </tr><tr role="row" class="odd">
                                  <td tabindex="0">  Civic &amp; Citizenship (Th.) </td>
                                  <td>100</td>
                                  <td>33</td>
                                  <td>70.00 </td>
                                 <td class="text text-center"><span class="label pull-right bg-green">Pass</span></td>
                            </tr><tr role="row" class="even">
                                  <td tabindex="0">  Geography (Th.) </td>
                                  <td>100</td>
                                  <td>33</td>
                                  <td>80.00 </td>
                                  <td class="text text-center"><span class="label pull-right bg-green">Pass</span></td>
                            </tr><tr role="row" class="odd">
                                  <td tabindex="0">  Islam &amp; Moral Edu/other (Th.) </td>
                                  <td>100</td>
                                  <td>33</td>
                                  <td>100.00 </td>
                                  <td class="text text-center"><span class="label pull-right bg-green">Pass</span></td>
                            </tr><tr class="hide even" role="row">
                                 <td tabindex="0"><b class="text text-info">Exam: 1st</b></td>
                                  <td><b class="text text-danger">Result: Fail</b></td>
                                    <td><b class="text-success">Grand Total: 1187/1700</b></td>
                                    <td><b class="text-warning">Percentage: 69.82%</b></td>
                                    <td></td>
      
                            </tr><tr class="hide odd" role="row">
                                  <td tabindex="0">Name: Sonia</td>
                                  <td>Roll Number: 52</td>
                                  <td>Admission Number: ST-01</td>
                                  <td>Class: Nine(B)</td>
                                  <td></td>
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
      
                       <div id="document" class="container tab-pane fade"><br>
                         <div class="timeline-header no-border">
                          <button type="button" data-student-session-id="3" class="btn btn-xs btn-primary pull-right myTransportFeeBtn"> <i class="fa fa-upload"></i>  Upload Documents</button>
                          <!-- <h2 class="page-header"> </h2> -->
                          <div class="table-responsive" style="clear: both;">
                              <div class="row">                                     
                              </div><table class="table table-striped table-bordered table-hover">
                                  <thead>
                                      <tr>
                                          <th>Title</th>
                                          <th>Name</th>
                                          <th class="mailbox-date text-right">Action </th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                        <td colspan="5" class="text-danger text-center">No Record Found</td>
                                    </tr>
                                  </tbody>
                              </table>
                          </div>  
                         </div>
                        </div>
                      </div>     
                       </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="tab-content">
                    <div class="tab-pane active" id="user-timeline">
                      <div class="timeline-post" id="modelAttendance" hidden>
                        <div class="post-media">
                          <div class="content" >
                            <div class="form-group col-md-12">


                            <h5><a href="#">{{$students->firstName}}</a></h5>

                               <label>Attendance Information</label><br><hr>
                               <div class="custom-control custom-control-inline">
                                <lable >Total Present This month &nbsp;</lable>
                                <lable  id="present"></lable> &nbsp DAY
                                </div><br>
                                <div class="custom-control month-radio custom-control-inline">
                                <lable >Total Absent This month &nbsp;</lable>
                                <lable id="absent"></lable> &nbsp DAY</div>
                                <div class="custom-control custom-control-inline">
                                    <a class=" nav-link" href="{{route('studentviewindex.index', $students->id)}}"> Details</a>
                                </div>
                          </div>
                          </div>
                        </div>
                        <div class="post-content">
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

        $('#Attendance').click(function (e) {
            e.preventDefault();
            $('#modelAttendance').attr('hidden',false);


      var d = new Date();
      var month=d.getMonth()+1;
      var studentId= {{$students->id}};
      console.log(studentId);
            //document.getElementById("date").innerHTML = month;
           //   $('table').attr('id',month);

    $.ajax({
        type: "get",
        url: "{{route('api.present')}}",
        data: {
            month :month,
            studentId:studentId,
        },
        success: function (data) {
         //var data1 =parseFloat(data.data).toFixed(2);
        $('#present').html(data.data);


           // document.getElementById("attendance").innerHTML= parseFloat(data).toFixed(2);
        }
    });
    $.ajax({
        type: "get",
        url: "{{route('api.absent')}}",
        data: {
            month :month,
            studentId:studentId,
        },
        success: function (data) {
         //var data1 =parseFloat(data.data).toFixed(2);
         $('#absent').html(data.data);

        }
    });

        });

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
