@extends('backend.student.layouts.master')
	@section('title', 'Attendance Page')
    @section('content')
    <div class="row ">
        <div class="col-md-3">
        <div class="tile p-0">
        <div class="form-group col-md-3">
              <label class="control-label mt-3">Month</label><br>
              @foreach (App\model\month::orderBy('id', 'ASC')->get() as $month)
                <div class="custom-control month-radio custom-control-inline">



                    <input type="radio" name="month" id="month{{$month->id}}" value="{{$month->id}}" class="custom-control-input admission">
                    <label class="custom-control-label"  for="month{{$month->id}}">{{$month->month}}</label>

                 </div>
                 @endforeach
              </div>
        </div>
        </div>




            <div class="col-md-5">
                <div class="tile">
                <h3 class=" row justify-content-md-center">Attendance Information </h3>
                    <div class="tile-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered" id="sampleTable">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Date</th>
                                        <th>attendance</th>

                                        <th>Last Attendance</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="tile">
                    <h3 class="tile-title">Attendance Information in Pie Chart</h3>
                    <div class="embed-responsive embed-responsive-16by9">
                        <canvas class="embed-responsive-item" id="pieChartDemo"></canvas>
                    </div>
                </div>
            </div>

            </div>
            <div class="row">


          </div>

      <div class="clearix"></div>
    @endsection
    @section('script')
       @include('backend.student.partials.js.datatable');

       <script src="{{ asset('admin/js/plugins/chart.js') }} "></script>
       <script type="text/javascript">

  $(function(){
  $('input[type="radio"]').click(function(){
    if ($(this).is(':checked'))
    {

      var month=$(this).val();
    //   $('table').attr('id',month);
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
             paging : true,
             destroy : true,
             ajax:"{{url('/student/attendance/show/')}}"+"/"+month,
             columns:[
                 { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                 { data: 'created_at1', name: 'created_at1' },

                 { data: 'attendence', name: 'attendence' },

                 { data: 'created_at', name: 'created_at' },
             ]
         });
        // table.destroy();
        table.draw();
        $.ajax({
            type: "get",
            url: "{{url('/student/attendance/attendancePercentage/')}}"+"/"+month,
            data: "data",

            success: function (response) {
                console.log(response);
                var absent=100- response;
                console.log(absent);
                var pdata = [{
                  value: response,
                  color: "#46BFBD",
                  highlight: "#5AD3D1",
                  label: "Persent"
              },
              {
                  value: absent,
                  color: "#F7464A",
                  highlight: "#FF5A5E",
                  label: "Absent"
              }

          ]



          var ctxp = $("#pieChartDemo").get(0).getContext("2d");
          var pieChart = new Chart(ctxp).Pie(pdata);

            }
        });
    }
  });
});


  </script>

@endsection
