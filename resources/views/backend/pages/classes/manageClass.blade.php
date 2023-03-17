@extends('backend.layouts.master')
	@section('title', 'Class Management')
    @section('content')
    {{-- //main content --}}
    <div class="app-title">
        <div>
          <h1><i class="fa fa-edit"></i> Manage Classes</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Home</li>
          <li class="breadcrumb-item"><a href="#">Manage Classes</a></li>
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
                                <th>Duration</th>
                                <th>Available Seat</th>
                                <th>Created Date</th>
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
            <div class="tile">
                <h3 class="tile-title border-bottom p-2" id="title">Add New Class</h3>
                <div class="tile-body">
                        <div class="form-group row">
                            <label class="control-label col-md-3 pl-4"> Class Name</label>
                            <div class="col-md-9">
                                <input class="form-control col-md-10" type="text" id="className" value="" name="className">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3 pl-4">Class Duration</label>
                            <div class="col-md-9">
                                <input class="form-control col-md-10" type="text" id="duration" name="duration">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3 pl-4">Available Seat</label>
                            <div class="col-md-9">
                                <input class="form-control col-md-10" type="text" id="seat" name="seat">
                            </div>
                        </div>

                </div>
                <div class="tile-footer">
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-primary edit_studClass"  style="float: right;" id="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Submit</button>
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
        // $(document).ready( function () {
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
                ajax:"{{url('class/show')}}",
                columns:[
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'className', name: 'className' },
                    { data: 'duration', name: 'duration' },
                    { data: 'seat', name: 'seat' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'action', name: 'action' }
                ]
            });
        // });


        //edit
        function editClass(id) {
            var editId=id;
            setUpdateProperty(editId, "Class");
            $("#submit").val(id);
            var url="{{url('class/edit')}}";
            $.ajax({
                type:'GET',
                url:url+"/"+id,
                dataType:"json",
                success:function(data) {
                    $('#className').val(data.className);
                    $('#duration').val(data.duration);
                    $('#seat').val(data.seat);
                    $('#comment').val(data.comment);
             }
            });
        }
          //update
          $('#submit').click(function (e) {
               e.preventDefault();
               var id=$('#submit').val();
               $.ajaxSetup({
               headers: {
                   'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                   },
               });
               var data={
                   className:$('#className').val(),
                   //numberOfClass:$('#numberOfClass').val(),
                   duration:$('#duration').val(),
                   seat:$('#seat').val(),
               };
               console.log(data);
               if (id>0) {
                   var url="{{url('class/update')}}"+"/"+id;
               }else{
                   var url="{{url('/class/store')}}"
               }
               $.ajax({
                   method:"POST",
                   url: url,
                   data: data,
                   success:function (result) {
                    if (result.success) {
                            $( "div" ).remove( ".text-danger" );
                            console.log(result);
                            successNotification();
                            removeUpdateProperty("Class");
                            document.getElementById("myform").reset();
                        }
                        if(result.errors){
                            getError(result.errors);
                        }
                }
            });

        });

         //delet
         function deleteStudentCls(id) {

            var url = "{{url('/class/delete')}}";
            //deleteAttribute(url,id);
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this file!",
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
                    swal("Cancelled", "Your file is safe :)", "error");
                }
            });
        }


    </script>

    @endsection
