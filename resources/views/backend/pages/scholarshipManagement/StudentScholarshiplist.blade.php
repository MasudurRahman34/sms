@extends('backend.layouts.master')
	@section('title', 'Scholarship Management')
    @section('content')
    {{-- //main content --}}
    <div class="app-title">
        <div class="hmmm">
          <h1><i class="fa fa-edit"></i> Manage Scholarship</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Home</li>
          <li class="breadcrumb-item"><a href="#">Manage Student Schoarship</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-7">
            <div class="tile">
              <div class="tile-body">
                <div class="table-responsive">
                <table class="table table-hover table-bordered" id="sampleTable">
                  <thead>
                    <tr>
                      <th></th>
                        <th>Roll</th>
                        <th>Class</th>
                        <th>Section</th>
                        <th>Shift</th>
                        <th>Name</th>
                        <th>Session </th>
                        <th>scholarship</th>
                        <th>Contact</th>
                        <th>Action</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-5">
            <form id="myform" action="javascript:void(0)">
                @csrf
                <div class="tile">
                    <h3 class="tile-title border-bottom p-2" id="title"> Create Student Scholarship List</h3>
                    <div class="tile-body">

                        
                        <div class="form-group">
                            <label for="exampleSelect1">Session Year</label>

                            <select class="form-control" id="sessionYearId" name="sessionYearId">
                                @foreach ($sessionYear as $year)
                                <option value="{{$year->id}}"{{$year->status == 1 ? 'selected': ''}}>{{$year->sessionYear}}</option>
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
                        <div class="form-group">
                        <label for="exampleSelect1">Select Class</label>
                            <select class="form-control admission" id="classId" name="classId">
                                <option value="">--Please Select--</option>
                                @foreach ($class as $class)
                                <option value="{{$class->id}}">{{$class->className}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlSelect1"> Section</label>
                                <select class="form-control studentIdAndfeeId" id="sectionId">
                                   {{--  <option value=""> --Please Select--  </option> --}}
                                </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1"> Student Name/Roll/ID</label>
                                <select class="form-control studentIdAndfeeId" id="studentId" required>
                                    
                                </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1"> scholarship List</label>
                                <select class="form-control studentIdAndfeeId" id="scholarshipId" required>
                                    <option value="">--Please Select--</option>
                                @foreach ($scholarships as $scholarship)
                                <option value="{{$scholarship->id}}" data-diccount ="{{ $scholarship->discount }}">{{$scholarship->name}}</option>
                                @endforeach
                                </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlSelect1"> Fee List</label>
                                <select class="form-control studentIdAndfeeId" id="feeId" required>
                                    <option value="">--Please Select--</option>
                               
                                </select>
                        </div>



                    </div>
                    <div class="tile-footer">
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-primary" type="submit" id="submit" style="float: right;"><i class="fa fa-fw fa-lg fa-check-circle"></i>Submit</button>
                                {{-- <input class="btn btn-primary" type="reset" style="float: right;"><i class="fa fa-fw fa-lg fa-check-circle"></i>Reset</button></a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="clearix"></div>
    @endsection
    @section('script')
      @include('backend.partials.js.datatable');
      <script>
            var table= $('#sampleTable').DataTable({
                dom: 'lBfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf',
                    {
                    extend: 'print',
                    exportOptions: {
                        columns: ':visible'
                            }
                    },
                    'colvis',
                ],
                columnDefs: [ {
                    // targets: -1,
                    visible: false
                } ],
                processing:true,
                serverSide:true,

                // fixedColumns: true,
                ajax:"{{url('/scholarship/list')}}",
                columns:[
                    {data: 'DT_RowIndex',name: 'DT_RowIndex'},
                    //{ data: 'studentId', name: 'studentId' },
                    { data: 'roll', name: 'roll' },
                    { data: 'className', name: 'className' },
                    { data: 'sectionName', name: 'sectionName'},
                    { data: 'shift', name: 'shift'},
                    { data: 'firstName', name: 'firstName' },
                    { data: 'sessionYear', name: 'sessionYear' },

                    { data: 'name', name: 'name'},
                    // { data: 'fatherName', name: 'fatherName'},
                    // { data: 'motherName', name: 'motherName'},
                    // { data: 'blood', name: 'blood'},
                    // { data: 'birthDate', name: 'birthDate'},
                    { data: 'mobile', name: 'mobile'},
                    { data: 'action', name: 'action' }
                ]
            });

         //update and submit

         //$("#classId").removeAttr("style")
         //$('#classId').attr("style", "pointer-events: auto;");
         //$("#classId option:selected").remove();
         
         //Load section by class
        $('.admission').change(function (e) {
        e.preventDefault();

        var classId= $("#classId option:selected").val();
        var sessionYearId=$('#sessionYearId option:selected').val();
        var shift=$('input[name="shift"]:checked').val();
        console.log(classId,sessionYearId,shift);
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
                    console.log(data);
                    var option="<option>--Please Select--</option>";
                    data.forEach(element => {
                        option+=("<option value='"+element.id+"'>"+element.sectionName+"</option>");
                    });
                    $('#sectionId').html(option);
                }
            });
        }
    });
    $('#sectionId').change(function (e) {
        e.preventDefault();

        sectionId=$(this).val();
        console.log(sectionId,classId);
    
            $.ajax({
                type: "POST",
                url: "{{ url('schoolarship/studentlist')}}",
                data: {
                sectionId:sectionId,
                
                },
                success: function (data) {
                //change start from here
                    if(data.length >0){
                        console.log(data);
                        var option="<option>--Please Select--</option>";
                        data.forEach(element => {
                        option+=("<option value='"+element.id+"'>"+element.firstName+' '+element.lastName+'/ Roll- '+element.roll+'/ ID- '+element.studentId+' '+"</option>");
                        });
                        $('#studentId').html(option);

                        }else{
                            alert('No student  found ! to add in scholarship list');
                        }
                    }
                });
            
        });//end sectionId      

    //fee list loading by class
    $('#scholarshipId').change(function (e) {
        e.preventDefault();

        var classId= $("#classId option:selected").val();
        var sessionYearId=$('#sessionYearId option:selected').val();
        var studentId =$('#studentId option:selected').val();
        
        console.log(sectionId);
        
                    $.ajax({
                type: "POST",
                url: "{{ url('schoolarship/feelist')}}",
                data: {
                classId:classId,
                sessionYearId:sessionYearId,
                
                },
                success: function (data) {
                //change start from here
                    if(data.length >0){
                        console.log(data);
                        var option="<option>--Please Select--</option>";
                        data.forEach(element => {
                        option+=("<option value='"+element.id+"'>"+element.name+"</option>");
                        });
                        $('#feeId').html(option);

                        }else{
                            alert('No Fee List found ! To add in scholarship list');
                        }
                    }
                });
            
        });//end sectionId      


         //submit 
         $('#submit').click(function (e) {
                e.preventDefault();
                var id=$('#submit').val();

                 var discount= $("#scholarshipId option:selected").data('diccount');
                 console.log(discount);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                });
                if (id>0) {
                   var url="{{url('scholarship/studentlist/update')}}"+"/"+id;
               }else{
                   var url="{{url('/schoolarship/studentlist/store')}}"
               }
                jQuery.ajax({
                    method: 'post',
                    url: url,
                    data: {
                    classId: $('#classId option:selected').val(),
                    sectionId:$('#sectionId option:selected').val(),
                    sessionYearId: $('#sessionYearId option:selected').val(),
                    shift: $('#shift:checked').val(),
                    
                    studentId:$('#studentId option:selected').val(),
                    scholarshipId:$('#scholarshipId option:selected').val(),
                    discount:discount,
                    feeId:$('#feeId option:selected').val(),
                    

                    },
                    success: function(result){
                        if (result.success) {
                            $( "div" ).remove( ".text-danger" );
                            console.log(result);
                            successNotification();
                            removeUpdateProperty("scholarship");
                            $("#classId").removeAttr("style");
                            $("#sessionYearId").removeAttr("style");
                            document.getElementById("myform").reset();
                        }
                        if(result.errors){
                            getError(result.errors);
                        }
                }
            });
        });
    //edit view


    function editScholarship(id) {
         var editId=id;
         // alert('do you like to edit id ');
         setUpdateProperty(editId, "scholarship");
         var url="{{url('schoolarship/list/edit')}}";
         $.ajax({
             type:'GET',
             url:url+"/"+id,
             success:function(data) {
                console.log(data);
                console.log(data.section.sessionYearId);
                console.log(data.section.classId);
                console.log(data.section.shift);
                console.log(data.section.id);
                console.log(data.student_scholarship[0].id);
                console.log(data.student_scholarship[0].feeId);

                console.log(data.sectionId);

                $('#sessionYearId').val(data.section.sessionYearId);
                 // $('#sessionYearId').attr("style", "pointer-events: none;");
                 $('#classId').val(data.section.classId);
                 // $('#classId').attr("style", "pointer-events: none;");
                 $('#sectionId').val(data.section.id);
                 
                 $('#studentId').val(data.id);
                 $('#scholarshipId').val(data.student_scholarship[0].id);
                 $('#feeId').val(data.student_scholarship[0].feeId);
                 
                 $("input[name='shift'][value='"+data.section.shift+"']").prop('checked', true);
                 // $('.pointer').css('pointer-events', 'none');
          }
         });




     }

     function deletestudentScholarshiplist(id) {
        var url = "{{url('/scholarship/studentlist/delete')}}";
       // deleteAttribute(url,id);
       

       swal({
        title: "Are you sure?",
        text: "You will not be able to recover this imaginary file!",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel plx!",
        closeOnConfirm: false,
        closeOnCancel: true,
    }, function(isConfirm) {
        if (isConfirm) {
       
          $.ajax({
              url:url+"/"+id,
              type:"GET",
              dataType:"json",
              success:function(data) {
                  if(data.error){
                   swal("Sorry",data.error , "error");
                  console.log(data.error);
                  }if(data.success){
                   table.draw();
                   swal(data.success);
                  }
              }
          })

        } else {
            swal("Cancelled", "Your data is safe :)", "error");
        }
    });


    }

    </script>

    @endsection
