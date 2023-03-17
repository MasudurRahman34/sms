@extends('backend.layouts.master')
	@section('title', 'Promotion Management')
    @section('content')
    {{-- //main content --}}
    <div class="app-title">
        <div class="hmmm">
          <h1><i class="fa fa-edit"></i>Promotion</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Home / Admin</li>
          <li class="breadcrumb-item"><a href="#">Promotion</a></li>
        </ul>
    </div>
    @include('backend.partials._message')
    <div class="row justify-content-md-center" id="searchoption" >

        <div class="clearix"></div>
            <div class="col-md-10">
                <div class="tile">

                   {{--  <h3 class="tile-title border-bottom p-2">Student Promotion Search</h3> --}}
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
                        </div>

                    </div>
                </div>
            </div>
        </div>
    <div class="clearix"></div>
    <div class="row justify-content-md-center" id="studentlist" hidden>
    <div class="col-md-10">
        <div class="tile">
                <div class="tile-body">
                       {{--  @if(count($errors)>0)
                            <div class="alert alert-danger" role="alert">
                              <ul>
                                @foreach($errors->all() as $error)
                                  <li>{{ $error }}</li>
                                @endforeach
                              </ul>
                            </div>
                          @endif
                          @if(Session::has('success'))
                            <div class="alert alert-success" role="alert">
                                {{ Session::get('success') }}
                            </div>
                            @endif
                            @if(Session::has('failed'))
                            <div class="alert alert-danger" role="alert">
                                {{ Session::get('failed') }}
                              </div>
                            @endif --}}
                            <br>
            <form action="{{route('promotion.store')}}" method="post" id="submitform">
               @csrf
               {{-- <input type="text" name="stdID" id="stdID" hidden> --}}
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                            <tr>
                               
                               {{-- <th><input type="checkbox" id="allcheckbox" /> Select All</th> --}}
                               

                                <th>ID</th>
                                <th>Roll</th>
                                <th>Name</th>
                                {{-- <th>Class</th>
                                <th>Section</th>
                                <th>Shift</th> --}}
                                <th>New Roll</th>
                                
                            
                            </tr>
                            </thead>
                             <tbody>
                            </tbody>
                        </table>
                    </div>
                     <!-- The Modal -->
                  <div class="modal" id="newModal" >
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                          <!-- Modal Header -->
                        <div class="modal-header">
                          <h4 class="modal-title">STUDENT PROMOTION</h4>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                         <!-- Modal body -->
                        <div class="modal-body">
                            <div class="row">
                            <div class="form-group col-xs-3 pr-2">
                                <label for="exampleFormControlSelect1">New Session Year</label>

                                <select class="form-control " id="promotesessionYear"  name="promotesessionYear" >

                                    <option value="">--Please Select--</option>
                                    @foreach ($sessionYear as $year)
                                        <option value="{{$year->id}}" {{$year->status == 1 ? 'selected': ''}}>{{$year->sessionYear}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-xs-2 pr-2">
                                <label class="control-label "> New Shift</label><br>
                                    {{-- <div class="custom-control shift-radio custom-control-inline">
                                        <input type="radio" name="promoteshift" id="shift1" value="Morning" class="custom-control-input promote" checked>
                                        <label class="custom-control-label"  for="shift1">Morning</label>
                                    </div>
                                    <div class="custom-control shift-radio custom-control-inline">
                                        <input type="radio" name="promoteshift" id="shift2" value="Day" class="custom-control-input promote">
                                        <label class="custom-control-label" for="shift2">Day</label>
                                    </div>
                                    <div class="custom-control shift-radio custom-control-inline">
                                        <input type="radio" name="promoteshift" id="shift3" value="Evening" class="custom-control-input promote">
                                        <label class="custom-control-label" for="shift3">Evening</label>
                                    </div> --}}
                                <select class="form-control promote" id="promoteshift" name="promoteshift" required>
                                    <option value="Morning">Morning</option>
                                    <option value="Day">Day</option>
                                    <option value="Evening">Evening</option>
                                </select>
                            </div>
                            <div class="form-group col-xs-3 pr-2">
                                <label for="exampleFormControlSelect1">Promote Class</label>
                                <select class="form-control promote" id="promoteclassId" name="classId" required>
                                    <option value="">--Please Select--</option>
                                   @foreach (App\model\classes::where('bId', Auth::user('web')->bId)->get() as $class)
                                <option value="{{$class->id}}">{{$class->className}}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="form-group col-xs-2 pr-2">
                                <label for="exampleFormControlSelect1">Promote Section</label>

                                <select class="form-control changeSubjectExamSection" id="promotesectionId" name="promotesectionId" required>
                                    <option value=""> --Please Select--  </option>
                                </select>
                            </div>
                            <div class="form-group col-xs-2 pr-2">
                                <label for="exampleFormControlSelect1">Promote Group</label>
                                <select class="form-control changeSubjectExamSection" id="promoteGroup" name="promoteGroup" required>

                                    <option value=""> --Please Select--  </option>
                                    <option value="General">General (1-8)</option>
                                    <option value="Science">Science</option>
                                    <option value="Arts">Arts</option>
                                    <option value="Commerece">Commerece</option>
                                    <option value="Vocational">Vocational</option>
                                </select>
                            </div>
                            </div>
                        </div>
                         <!-- Modal footer -->
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-success" id="update" >Promote Student</button>
                          <button type="button" class="btn btn-danger" id="cancel" data-dismiss="modal">Close</button>
                        </div>

                    </div>      
                    </div>
                </div>


        <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-success" id="showmodel" >Promote Student</button>
              <button type="button" class="btn btn-danger" id="cancel" data-dismiss="modal">Close</button>
            </div>
         </form>
                </div>
            </div>
        </div>
    </div>

      <div class="clearix"></div>
     

      

       
    @endsection
    @section('script')
    @include('backend.partials.js.datatable');

    <script>

   
dynamicSectionSelection();
// $('#searchoption').attr('hidden',false);
 // function checkedAtlestOne(){

 //    $("#submitform").submit(function () {
 //        var idChecked= new Array;
 //        var roll=true;
 //        $("#submitform input[type=checkbox]:checked").each(function(){
 //            idChecked.push(this.value);
 //        });
 //        if(idChecked.length>0){
            
 //            return roll=true;
 //        }else{
 //            alert('pleace select one');
 //            roll= false;
 //        }return roll;

 //      });
 //     }
     //showmodel button
     $('#showmodel').click(function (e){
        e.preventDefault();
         //checkedAtlestOne();
          $("#newModal").modal("show");

     });
     //cancel button
     $('#cancel').click(function (e){
        e.preventDefault();
        $('#searchoption').attr('hidden',false);
        $('#studentlist').attr('hidden',true);

     });

    $('#studentlist').attr('hidden',true);


    $('.promote').change(function (e) {
        e.preventDefault();

        // $('#informationDiv').attr('hidden',true);
        // $('#resultDiv').attr('hidden',true);
        var classId= $("#promoteclassId option:selected").val();
        var sessionYearId=$('#promotesessionYear option:selected').val();
        var shift=$('#promoteshift option:selected').val();
        //var shift=$('input[name="promoteshif"]:checked').val();
        console.log(classId,sessionYearId,shift);
        var url='/api/search/sectionbyclass';
        var data= {
            'classId' : classId,
            'sessionYearId' : sessionYearId,
            'shift' : shift,
        }
        console.log(data);
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
                    $('#promotesectionId').html(option);
                }
            });
        }
    });

        //for promotion option
     $('#promotesectionId').change(function (e) {
        e.preventDefault();

        sectionId=$('#promotesectionId option:selected').val();
        var classId= $("#promoteclassId option:selected").val();
        var sessionYearId=$('#promotesessionYear option:selected').val();
        var shift=$('#promoteshif option:selected').val();
        //var shift=$('input[name="promoteshif"]:checked').val();
        console.log(sectionId,sessionYearId,classId,shift);

    }); 
       
    //only used for 1st section find 
    $('#sectionId').change(function (e) {
        e.preventDefault();


        //$('#searchoption').attr('hidden',true);
       
        sectionId=$('#sectionId option:selected').val();
        var classId= $("#classId option:selected").val();
        var sessionYearId=$('#sessionYear option:selected').val();
        var shift=$('input[name="shift"]:checked').val();
        console.log(sectionId,sessionYearId,classId,shift);

                
            $.ajax({
                type: "get",
                url:"{{url('adminview/student/promotionlist')}}"+'/'+classId+'/'+sectionId+'/'+sessionYearId,
                data:{
                    sectionId:sectionId,
                    sessionYearId:sessionYearId,
                    classId:classId,
                    shift:shift,
                },
           
            success: function (response){

                 if(response.length>0){
                    // $('#tblHidden').attr('hidden',false);
                    // $('#btnFee').attr('disabled',false);
                     $('#studentlist').attr('hidden',false);
                    var tr='';
                    $.each (response, function (key, value) {
                    tr +=
                        "<tr>"+

                            "<td>"+value.studentId+"</td>"+
                            "<td>"+value.roll+"</td>"+
                            "<td>"+value.firstName+' '+value.lastName+"</td>"+
                            "<td>"+
                                '<input class="stdroll" type="number" name="student['+value.id+']" value="0" >'
                            +"</td>"+
                            // "<td>"+value.className+"</td>"+
                            // "<td>"+value.sectionName+"</td>"+
                            // "<td>"+value.shift+"</td>"+
                        "</tr>";
                    });
                        $('tbody').html(tr);
                        //checkedAtlestOne();
                }//End if
                else{
                    $('#studentlist').attr('hidden',true);
                    //no data found
                }
            }
        });

        // $('#allcheckbox').change(function () {
        // $('tbody tr td input[type="checkbox"]').prop('checked', $(this).prop('checked'));
        // });

    });//end sectionId
    //Get fee amount in change of fee name
    //'<input class="stdroll" type="number" name="studentroll['+value.roll+']" >'

    






//print button in table
// $('#doPrint').on("click", function () {
//     $('#print_div').printThis({
//         debug: false,               // show the iframe for debugging
//         importCSS: true,            // import parent page css
//         importStyle: true,         // import style tags
//         printContainer: true,       // print outer container/$.selector
//         loadCSS: "",                // path to additional css file - use an array [] for multiple
//         pageTitle: "",              // add title to print page
//         removeInline: false,        // remove inline styles from print elements
//         removeInlineSelector: "*",  // custom selectors to filter inline styles. removeInline must be true
//         printDelay: 533,            // variable print delay
//         header: null,               // prefix to html
//         footer: null,               // postfix to html
//         base: false,                // preserve the BASE tag or accept a string for the URL
//         formValues: true,           // preserve input/form values
//         canvas: false,              // copy canvas content
//         doctypeString: '...',       // enter a different doctype for older markup
//         removeScripts: false,       // remove script tags from print content
//         copyTagClasses: false,      // copy classes from the html & body tag
//         beforePrintEvent: null,     // function for printEvent in iframe
//         beforePrint: show,          // function called before iframe is filled
//         afterPrint: hide,            // function called before iframe is removed
//     });
//   });

    </script>
    @endsection
