@extends('backend.student.layouts.master')
	@section('title', 'Attendance Page')
    @section('content')
    <div class="row justify-content-md-center">
            <div class="col-md-7">
                <div class="tile">
                <h3 class=" row justify-content-md-center">Teacher Information </h3>
                    <div class="tile-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered" id="sampleTable">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th> Name</th>
                                        <th>Mobile</th>
                                        <th>Email</th>
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
             ajax:"{{url('student/teacher/list/show')}}",
             columns:[
                 { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                 { data: 'name', name: 'name' },
                 { data: 'mobile', name: 'mobile' },
                 { data: 'email', name: 'email' },
             ]
         });
        // table.destroy();

        // $.ajax({
        //     type: "get",
        //     url: "{{url('/student/attendance/attendancePercentage/')}}"+"/"+month,
        //     data: "data",

        //     success: function (response) {
        //         console.log(response);
        //         var absent=100- response;
        //         console.log(absent);
        //         var pdata = [{
        //           value: response,
        //           color: "#46BFBD",
        //           highlight: "#5AD3D1",
        //           label: "Persent"
        //       },
        //       {
        //           value: absent,
        //           color: "#F7464A",
        //           highlight: "#FF5A5E",
        //           label: "Absent"
        //       }

        //   ]



        //   var ctxp = $("#pieChartDemo").get(0).getContext("2d");
        //   var pieChart = new Chart(ctxp).Pie(pdata);

        //     }
        // });

  });
});
  </script>

@endsection
