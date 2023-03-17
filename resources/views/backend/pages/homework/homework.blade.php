@extends('backend.layouts.master')
	@section('title', 'Homework Management')
    @section('content')
    {{-- //main content --}}
    <div class="app-title">
        <div class="hmmm">
          <h1><i class="fa fa-edit"></i>Home work Manage</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Home</li>
          <li class="breadcrumb-item"><a href="#">Manage Student home work</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="tile">
              <div class="tile-body">
                <div class="table-responsive">
                <table class="table table-hover table-bordered" id="sampleTable">
                  <thead>
                    <tr>
                      <th></th>
                       <th>subject</th>
                        <th>title</th>
                        <th>description</th>
                        <th>submit date</th>
                       
                        <th>class </th>
                        <th>section</th>
                        <th>group</th>
                        <th>create by</th>
                        <th>Action</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-4">
            <form id="myform" action="javascript:void(0)">
                @csrf
                <div class="tile">
                    <h3 class="tile-title border-bottom p-2" id="title"> Create home Work</h3>
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
                            <label for="exampleFormControlSelect1"> Group</label>
                                <select class="form-control admission" id="group">
                                    <option value=""> Please Select </option>
                                    <option value="General"> General </option>
                                    <option value="Science"> Science </option>
                                    <option value="Arts"> Arts </option>
                                    <option value="Commerce"> Commerce </option>
                                </select>
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
                                <select class="form-control studentSubjectist" id="sectionId">
                                   {{--  <option value=""> --Please Select--  </option> --}}
                                </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1"> Subject list/Subject code</label>
                                <select class="form-control studentSubjectist" id="subjectId" required>
                                    
                                </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleSelect1">Home work Title</label>
                                <input class="form-control"  type="text" id="htitle" name="htitle" placeholder="Enter title">
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Home work Description</label>
                                {{-- <label for="exampleSelect1">Home work Title</label> --}}
                                {{-- <input class="form-control"  type="text" id="description" name="description" placeholder="Enter description"> --}}
                                <textarea class="form-control" name="description" id="description" form="usrform" placeholder="Enter description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleSelect1">Submit Date</label>
                                <input class="form-control"  type="date" id="endDate" name="endDate" min="">
                        </div>



                    </div>
                    <div class="tile-footer">
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-lg btn-primary" type="submit" id="submit" style="float: right;"><i class="fa fa-fw fa-lg fa-check-circle"></i>Submit</button>
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
                ajax:"{{url('/homework/show')}}",
                columns:[
                    {data: 'DT_RowIndex',name: 'DT_RowIndex'},
                    //{ data: 'studentId', name: 'studentId' },
                    { data: 'subjectId', name: 'subjectId'},
                    { data: 'title', name: 'httle' },
                    { data: 'description', name: 'description' },
                    { data: 'endDate', name: 'endDate'},
                    { data: 'classId', name: 'classId' },
                    { data: 'sectionId', name: 'sectionId'},
                    { data: 'group', name: 'group'},
                    { data: 'userId', name: 'userId' },
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

        var group= $("#group option:selected").val();
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

            //subjectlist
            //
            //ok
            var url='/api/search/classsubject';
            var data={
                'classId':classId,
                'group':group,
            }
            $.ajax({
                type: "post",
                url:url,
                data: data,
                success: function (data) {
                    console.log(data);
                    var option="<option>--Please Select--</option>";
                    data.forEach(element => {
                        option+=("<option value='"+element.id+"'>"+element.subjectName+"</option>");
                    });
                    $('#subjectId').html(option);
                }
            });
        }
    });
   


         //submit form
         $('#submit').click(function (e) {
                e.preventDefault();
                var id=$('#submit').val();
                 var shift=$('input[name="shift"]:checked').val();
                 var  title=$('#htitle').val();
                 console.log(id,shift,title);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                });
                if (id>0) {
                   var url="{{url('/homework/update')}}"+"/"+id;
               }else{
                   var url="{{url('/homework/store')}}"
               }
                jQuery.ajax({
                    method: 'post',
                    url: url,
                    data: {
                    classId: $('#classId option:selected').val(),
                    sectionId:$('#sectionId option:selected').val(),
                    sessionYearId: $('#sessionYearId option:selected').val(),
                    group: $('#group option:selected').val(),
                    shift: shift,
                    
                    subjectId:$('#subjectId option:selected').val(),
                    title:$('#htitle').val(),
                    description:$('#description').val(),
                    endDate:$('#endDate').val(),
                    

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


    function edithomework(id) {
         var editId=id;
         // alert('do you like to edit id ');
         setUpdateProperty(editId, "home work");
         var url="{{url('homework/edit')}}";
         $.ajax({
             type:'GET',
             url:url+"/"+id,
             success:function(data) {
                 console.log(data);
                // console.log(data.section.sessionYearId);
                // console.log(data.section.classId);
                // console.log(data.section.shift);
                // console.log(data.section.id);
                // console.log(data.student_scholarship[0].id);
                // console.log(data.student_scholarship[0].feeId);

                // console.log(data.sectionId);

                $('#sessionYearId').val(data.sessionYearId);
                 // $('#sessionYearId').attr("style", "pointer-events: none;");
                //$('#classId').val(data.classId);
                 // $('#classId').attr("style", "pointer-events: none;");
                 $('#sectionId').val(data.sectionId);
                 $('#subjectId').val(data.subjectId);
                 
                 $('#description').val(data.description);
                 $('#htitle').val(data.title);
                 $('#endDate').val(data.endDate);
                 $('#group').val(data.group);
                 
                 //$("input[name='shift'][value='"+data.section.shift+"']").prop('checked', true);
                 // $('.pointer').css('pointer-events', 'none');
          }
         });




     }

     function deletehomework(id) {
        var url = "{{url('/homework/delete')}}";
       
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
            swal("Cancelled", "Your file is safe :)", "error");
        }
    });


    }

    </script>

    @endsection
