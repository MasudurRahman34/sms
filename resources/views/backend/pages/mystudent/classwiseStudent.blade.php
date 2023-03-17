@extends('backend.layouts.master')
	@section('title', 'Find Student Class Wish')
    @section('content')
    <div class="app-title">
        <div>
          <h1><i class="fa fa-edit"></i>ClassWise Student</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Home</li>
          <li class="breadcrumb-item"><a href="#">ClassWise Student</a></li>
        </ul>
    </div>
    <div class="row justify-content-md-center">
        <div class="col-md-9">
            <div class="tile">
                    <div class="tile-body">
                        <form class="row" id="myform" action="javascript:void(0)">
                        <div class="form-group col-md-3" >
                            <label for="exampleFormControlSelect1">Session Year</label>
                            <select class="form-control admission" id="sessionYear">
                              <option value="">--Please Select--</option>
                              @foreach ($sessionYear as $year)
                                <option value="{{$year->id}}" {{$year->status == 1 ? 'selected': ''}}>{{$year->sessionYear}}</option>
                              @endforeach
                            </select>
                          </div>
                          <!-- single section-->
                          <div class="form-group col-md-4">
                            <label for="exampleFormControlSelect1">Select Class</label>
                            <select class="form-control admission" id="classId">
                              <option value="">--Please Select-- </option>
                              @foreach ($class as $class)
                              <option value="{{$class->id}}">{{$class->className}}</option>
                              @endforeach
                            </select>
                          </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
<div class="clearix"></div>
<div class="row justify-content-md-center">
    <div class="col-md-9">
        <div class="tile">
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                            <tr>
                                <th></th>
                                {{--  <th>student ID</th>  --}}
                                <th>Roll</th>
                                <th>Name</th>

                               {{-- <th>Class</th>
                                <th>Section</th>
                                <th>Shift</th>  --}}
                                {{-- <th>Session Year</th> --}}
                                <th>Father Name</th>
                                <th>Mother Name</th>
                                <th>Blood Group</th>
                                <th>Date of Birth</th>
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
            var table="";
            $('#classId').change(function (e) {
                e.preventDefault();
                var classId=$(this).val();
                var sessionYearId=$('#sessionYear').val();
                console.log(classId,sessionYearId);
                var table2= $('#sampleTable').DataTable({
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
                pagin:true,
                destroy:true,
                ajax:"{{url('mystudent/classwiseList/')}}"+'/'+classId+'/'+sessionYearId,
                columns:[
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    //{ data: 'studentId', name: 'studentId' },

                    { data: 'roll', name: 'roll' },
                    { data: 'firstName', name: 'firstName' },
                    //{ data: 'className', name: 'className' },
                    //{ data: 'sectionName', name: 'sectionName'},
                    //{ data: 'shift', name: 'shift'},
                    // { data: 'session_years', name: 'session_years'},
                    { data: 'fatherName', name: 'fatherName'},
                    { data: 'motherName', name: 'motherName'},
                    { data: 'blood', name: 'blood'},
                    { data: 'birthDate', name: 'birthDate'},
                    { data: 'mobile', name: 'mobile'},
                    { data: 'action', name: 'action' }
                ]
            });
table=table2;


    });
 //delete

 function deleteStudent(id) {
    var url = "{{url('mystudent/student/delete')}}";

    deleteAttribute(url,id);
}


    </script>

    @endsection
