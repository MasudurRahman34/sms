@extends('backend.layouts.master')
	@section('title', 'Session Year')
    @section('content')
    {{-- //main content --}}
    <div class="app-title">
        <div>
          <h1><i class="fa fa-edit"></i>Manage Session Year</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Home</li>
          <li class="breadcrumb-item"><a href="#">Manage Session Year</a></li>
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
                                <th>#</th>
                                <th>Session Year</th>
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
                <h3 class="tile-title border-bottom p-2" id="date">Add Session Year</h3>
                <div class="tile-body">
                        <div class="form-group row">
                            <label class="control-label col-md-3 pl-4"> Session Year</label>
                            <div class="col-md-9">
                                <input class="form-control col-md-10" type="text" id="sessionYear" value="" name="sessionYear">
                            </div>
                        </div>
                </div>
                <div class="tile-footer">
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-primary edit_studClass" type="submit" style="float: right;" id="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Submit</button>
                            {{-- <input class="btn btn-primary edit_studClass" type="reset" style="float: right;" id="reset"><i class="fa fa-fw fa-lg fa-check-circle"></i>Submit</button> --}}
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
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                processing:true,
                serverSide:true,
                ajax:"{{url('sessionyear/show')}}",
                columns:[
                    { data: 'hash', name: 'hash' },
                    { data: 'sessionYear', name: 'sessionYear' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'action', name: 'action' }
                ]
            });


        // $(document).ready( function () {
            $('#submit').click(function(e) {
                e.preventDefault();

                var data={
                    'sessionYear':$('#sessionYear').val(),
                }
                $.ajaxSetup({
               headers: {
                   'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                   },
               });
                $.ajax({
                    type: "post",
                    url: "{{url('/sessionyear/store')}}",
                    data: data,
                    // dataType: "dataType",
                    success: function (response) {
                        successNotification();
                        document.getElementById("myform").reset();

                    }
                });

            })

    </script>

    @endsection
