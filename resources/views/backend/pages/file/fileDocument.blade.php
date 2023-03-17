@extends('backend.layouts.master')
	@section('title', 'File Document')
    @section('content')
    {{-- //main content --}}
    <div class="app-title">
        <div>
          <h1><i class="fa fa-edit"></i> File Upload</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Home</li>
          <li class="breadcrumb-item"><a href="#">File Upload</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-7">
            <div class="tile">
                <div class="tile-body">
                    <div class="table-responsive">
                        <table id="files_table" class="table table-hover table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Class Name</th>
                                <th>File Type</th>
                                <th>Created Date</th>
                                <th>Download</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-5">
                <form id="myform" action="{{route('file.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                <div class="tile">
                    <h3 class="tile-title border-bottom p-2" id="title">Add New Book</h3>
                    <br>
                    @if(count($errors)>0)
                    <div class="alert alert-danger" role="alert">
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    </div>
                @endif
                @if(Session::has('success'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        {{ Session::get('success') }}
                    </div>
                    @endif
                    @if(Session::has('failed'))
                    <div class="alert alert-danger" role="alert">
                        {{ Session::get('failed') }}
                    </div>
                    @endif
                    @if(Session::has('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ Session::get('error') }}
                    </div>
                @endif
                <div class="form-group row">
                    <label class="control-label col-md-3">Class Name</label>
                    <div class="col-md-8">
                    <input class="form-control" type="text" name="className" id="className">
                    </div>
                </div>
                 
                <div class="form-group row">
                    <label class="control-label col-md-3">Upload Link</label>
                    <div class="col-md-8">
                    <input class="form-control" type="text" name="fileName" id="fileName" >
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
            </div>
                </form>
        </div>

    </div>

      <div class="clearix"></div>
    @endsection
    @section('script')
      @include('backend.partials.js.datatable');
      <script>
          $(document).ready( function () {
            $('#files_table').DataTable({
                processing:true,
                serverSide:true,
                ajax:"{{url('file/datatable')}}",
                columns:[
                    { data: 'hash', name: 'hash' },
                    { data: 'className', name: 'className' },
                    { data: 'type', name: 'type' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'download', name: 'download' }
                ]
            });
        });
        // $(document).ready( function () {
        //    var table= $('#sampleTable').DataTable({
        //         dom: 'lBfrtip',
        //         buttons: [
        //             'copy', 'csv', 'excel', 'pdf', 'print'
        //         ],
        //         processing:true,
        //         serverSide:true,
        //         ajax:"{{url('class/show')}}",
        //         columns:[
        //             { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        //             { data: 'className', name: 'className' },
        //             { data: 'duration', name: 'duration' },
        //             { data: 'seat', name: 'seat' },
        //             { data: 'created_at', name: 'created_at' },
        //             { data: 'action', name: 'action' }
        //         ]
        //     });
        // });


        //edit
        // function editClass(id) {
        //     var editId=id;
        //     setUpdateProperty(editId, "Class");
        //     $("#submit").val(id);
        //     var url="{{url('class/edit')}}";
        //     $.ajax({
        //         type:'GET',
        //         url:url+"/"+id,
        //         dataType:"json",
        //         success:function(data) {
        //             $('#className').val(data.className);
        //             $('#duration').val(data.duration);
        //             $('#seat').val(data.seat);
        //             $('#comment').val(data.comment);
        //      }
        //     });
        // }
        //   //update
        //   $('#submit').click(function (e) {
        //        e.preventDefault();
        //        var id=$('#submit').val();
        //        $.ajaxSetup({
        //        headers: {
        //            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        //            },
        //        });
        //        var data={
        //            className:$('#className').val(),
        //            //numberOfClass:$('#numberOfClass').val(),
        //            duration:$('#duration').val(),
        //            seat:$('#seat').val(),
        //        };
        //        console.log(data);
        //        if (id>0) {
        //            var url="{{url('class/update')}}"+"/"+id;
        //        }else{
        //            var url="{{url('/class/store')}}"
        //        }
        //        $.ajax({
        //            method:"POST",
        //            url: url,
        //            data: data,
        //            success:function (result) {
        //             if (result.success) {
        //                     $( "div" ).remove( ".text-danger" );
        //                     console.log(result);
        //                     successNotification();
        //                     removeUpdateProperty("Class");
        //                     document.getElementById("myform").reset();
        //                 }
        //                 if(result.errors){
        //                     getError(result.errors);
        //                 }
        //         }
        //     });

        // });


    </script>

    @endsection
