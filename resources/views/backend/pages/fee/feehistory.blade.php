@extends('backend.layouts.master')
	@section('title', 'Fee Management')
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
    <div class="row justify-content-md-center">
    <div class="col-md-7">
            <div class="tile">
              <div class="tile-body">
                <div class="table-responsive">
                <table class="table table-hover table-bordered" id="sampleTable">
                  <thead>
                    <tr>
                      <th></th>
                      <th>Fee Name</th>
                      <th>Amount</th>
                      <th>change Date</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
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
         ajax:"{{url('/feehistory/show')}}",
         columns:[
             { data: 'DT_RowIndex', name: 'DT_RowIndex' },
             //{ data: 'Fee.name', name: 'Fee.name' },
             { data: 'feeId', name: 'feeId' },
             { data: 'amount', name: 'amount' },
             { data: 'created_at', name: 'created_at' },

         ]
     });

    </script>

    @endsection

