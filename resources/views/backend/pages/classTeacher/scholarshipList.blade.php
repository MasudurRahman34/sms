@extends('backend.layouts.master')
	@section('title', 'Scholarship List Page')
    @section('content')
    <div class="app-title">
        <div>
          <h1><i class="fa fa-edit"></i>Manage scholarship List</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Home</li>
          <li class="breadcrumb-item"><a href="#">Scholarship List</a></li>
        </ul>
    </div>
<div class="row justify-content-md-center">
    <div class="col-md-10">
        <div class="tile">
                <div class="tile-body">
                    {{--  <form class="row" id="myform" action="javascript:void(0)">
                        <div class="form-group col" >
                            <label for="exampleFormControlSelect1">Session Year</label>
                            <select class="form-control admission" id="sessionYear">
                              <option value="">--Please Select--</option>
                              @foreach ($sessionYear as $year)
                                <option value="{{$year->id}}" {{$year->status == 1 ? 'selected': ''}}>{{$year->sessionYear}}</option>
                              @endforeach
                            </select>
                        </div>
                    </form>  --}}
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                            <tr>
                                <th></th>
                                {{--  <th>ID</th>  --}}
                                <th>Roll</th>
                                <th>Class</th>
                                <th>Section</th>
                                <th>Shift</th>

                                <th>Name</th>
                                <th>Session </th>

                                <th>scholarship</th>
                                <th>Father</th>
                                <th>Mother</th>
                                <th>Blood Group</th>
                                <th>Birth Date</th>
                                <th>Contact</th>
                                <th>Action</th>
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
      @include('backend.partials.js.datatable');
      <script>
        // $(document).ready( function () {

        //$('#sessionYear').click(function (e) {
           // e.preventDefault();

       // var sessionYearId=$("#sessionYear").val();
           // console.log(sessionYearId);
        var sectionId = {{$sectionId}};

        var classId ={{$classId}};

        var sessionYearId = {{$sessionYearId}};

        console.log(classId, sectionId, sessionYearId);
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
                ajax:"{{url('myclass/schoarship/list')}}"+'/'+classId+'/'+sectionId+'/'+sessionYearId,
                columns:[
                    {data: 'DT_RowIndex',name: 'DT_RowIndex'},
                    //{ data: 'studentId', name: 'studentId' },
                    { data: 'roll', name: 'roll' },
                    { data: 'className', name: 'className' },
                    { data: 'sectionName', name: 'sectionName'},
                    { data: 'shift', name: 'shift'},
                    { data: 'firstName', name: 'firstName' },
                    { data: 'sessionYear', name: 'sessionYear' },

                    { data: 'name', name: 'name'},
                    { data: 'fatherName', name: 'fatherName'},
                    { data: 'motherName', name: 'motherName'},
                    { data: 'blood', name: 'blood'},
                    { data: 'birthDate', name: 'birthDate'},
                    { data: 'mobile', name: 'mobile'},
                    { data: 'action', name: 'action' }
                ]
            });
       // });

        //delete
        function deleteStudent(id) {
            var url = "{{url('mystudent/student/delete')}}";
            deleteAttribute(url,id);
    }

    </script>
    @endsection
