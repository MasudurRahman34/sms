@extends('backend.student.layouts.master')
	@section('title', 'home work Page')
    @section('content')
    <div class="row justify-content-md-center">
            <div class="col-md-7">
                <div class="tile">
                <h3 class=" row justify-content-md-center">homework Information </h3><hr>
                    <div class="tile-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered" id="sampleTable">
                                <thead>
                                    <tr>
                                        <th></th>

                                        <th>subject</th>
                                        <th> Title</th>
                                        <th>Description</th>
                                        <th>Submit date</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            </div>
      <div class="clearix"></div>
    @endsection
    @section('script')
       @include('backend.student.partials.js.datatable');

    <script src="{{ asset('admin/js/plugins/chart.js') }} "></script>
    <script type="text/javascript">

    $(function(){
    $(document).ready(function () {

      var table=$('#sampleTable').DataTable({
            dom: 'lBfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf','print'

            ],
            columnDefs: [ {
                // targets: -1,
                visible: false
            } ],
             processing:true,
             serverSide:true,
             ajax:"{{url('student/homework/list/show')}}",
             columns:[
                 { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                 { data: 'subjectId', name: 'subjectId' },
                 { data: 'title', name: 'tite' },
                 { data: 'description', name: 'description' },
                 { data: 'endDate', name: 'endDate' },
             ]
         });

  });
});
  </script>

@endsection
