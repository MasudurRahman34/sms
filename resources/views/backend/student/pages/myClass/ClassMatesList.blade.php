@extends('backend.student.layouts.master')
	@section('title', 'ClassMates Page')
    @section('content')
    <div class="row justify-content-md-center">
            <div class="col-md-8">
                <div class="tile">
                <h3 class=" row justify-content-md-center">My class Mates Information </h3>
                    <div class="tile-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered" id="sampleTable">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Roll</th>
                                        <th>Student ID</th>
                                        <th>Name</th>
                                        <th>Mobile</th>
                                        <th>Email</th>
                                        <th>Father Name</th>
                                        <th>Mother Name</th>

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
             ajax:"{{url('student/class/classmates/show')}}",
             columns:[
                 { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                 { data: 'roll', name: 'roll' },
                 { data: 'studentId', name: 'studentId' },
                 { data: 'firstName', name: 'firstName' },
                 { data: 'mobile', name: 'mobile' },
                 { data: 'email', name: 'email' },
                 { data: 'fatherName', name: 'fatherName'},
                 { data: 'motherName', name: 'motherName'},
             ]
         });

  });
});
  </script>

@endsection
