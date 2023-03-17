@extends('backend.layouts.master')
	@section('title', 'Section Management')
    @section('content')
    {{-- //main content --}}
    <div class="app-title">
        <div class="hmmm">
          <h1><i class="fa fa-edit"></i> Manage Section</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Home</li>
          <li class="breadcrumb-item"><a href="#">Manage Section</a></li>
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
                      <th>Class Name</th>
                      <th>Section</th>
                      <th>Study Shift</th>
                      <th>Session Year</th>
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
                <h3 class="tile-title border-bottom p-2" id="title"> Add Study Section</h3>
                <div class="tile-body">

                    <div class="form-group">
                    <label for="exampleSelect1">Select Class</label>
                    <select class="form-control" id="classId" name="classId">
                    @foreach ($class as $class)
                    <option value="{{$class->id}}">{{$class->className}}</option>
                    @endforeach

                    </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleSelect1">Session Year</label>

                        <select class="form-control" id="sessionYearId" name="sessionYearId">
                            @foreach ($sessionYear as $year)
                            <option value="{{$year->id}}"{{$year->status == 1 ? 'selected': ''}}>{{$year->sessionYear}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleSelect1">Section Name</label>
                            <input class="form-control"  type="text" id="sectionName" name="sectionName" placeholder="Enter Section Name">
                    </div>

                    <legend type="hidden">Study Shift</legend>
                    <div class="form-check">
                        <label class="radio">
                            <input type="radio" id="shift" name="shift"  value="Morning" checked class="pointer"> Morning
                        </label> &nbsp;
                        <label class="radio">
                            <input type="radio"  id="shift" name="shift"  value="Day" class="pointer"> Day
                        </label>
                        <label class="radio">
                            <input type="radio"  id="shift" name="shift"  value="Evening" class="pointer"> Evening
                        </label>
                    </div>
                </div>
                <div class="tile-footer">
                    <div class="row">
                        <div class="col-md-12">
                        <button class="btn btn-primary" type="submit" id="submit" style="float: right;"><i class="fa fa-fw fa-lg fa-check-circle"></i>Submit</button></a>
                        {{-- <input class="btn btn-primary" type="reset" style="float: right;"><i class="fa fa-fw fa-lg fa-check-circle"></i>Reset</button></a> --}}
                        </div>
                    </div>
                </div>
                </div>
            </form>
        </div>
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
             ajax:"{{url('/section/show')}}",
             columns:[
                 { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                 { data: 'classes.className', name: 'classes.className' },
                 { data: 'sectionName', name: 'sectionName' },
                 { data: 'shift', name: 'shift' },
                 { data: 'session_year.sessionYear', name: 'session_year.sessionYear' },
                 { data: 'action', name: 'action' }
             ]
         });

         //update and submit

         //$("#classId").removeAttr("style")
         //$('#classId').attr("style", "pointer-events: auto;");
         //$("#classId option:selected").remove();


         $('#submit').click(function (e) {
                e.preventDefault();
                var id=$('#submit').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                });
                if (id>0) {
                   var url="{{url('section/update')}}"+"/"+id;
               }else{
                   var url="{{url('/section/store')}}"
               }
                jQuery.ajax({
                    method: 'post',
                    url: url,
                    data: {
                    sectionName: $('#sectionName').val(),
                    classId: $('#classId option:selected').val(),
                    sessionYearId: $('#sessionYearId option:selected').val(),
                    sectionName: $('#sectionName').val(),
                    shift: $('#shift:checked').val(),
                    },
                    success: function(result){
                        if (result.success) {
                            $( "div" ).remove( ".text-danger" );
                            console.log(result);
                            successNotification();
                            removeUpdateProperty("section");
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


    function editSection(id) {
         var editId=id;
         setUpdateProperty(editId, "section");
         var url="{{url('/section/edit')}}";
         $.ajax({
             type:'GET',
             url:url+"/"+id,
             success:function(data) {

                 $('#classId').val(data.classId);
                $('#classId').attr("style", "pointer-events: none;");
                 $('#sectionName').val(data.sectionName);
                 $('#sessionYearId').val(data.sessionYearId);
                 $('#sessionYearId').attr("style", "pointer-events: none;");
                 console.log(data);
                 $("input[name='shift'][value='"+data.shift+"']").prop('checked', true);
                 $('.pointer').css('pointer-events', 'none');
          }
         });




     }

     function deleteSection(id) {
        var url = "{{url('/section/delete')}}";
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
       //    var url = "{{url('/section/delete')}}";
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
            swal("Cancelled", "Your imaginary file is safe :)", "error");
        }
    });


    }

    </script>

    @endsection
