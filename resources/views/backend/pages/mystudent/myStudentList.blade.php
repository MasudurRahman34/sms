@extends('backend.layouts.master')
	@section('title', 'Student List Page')
    @section('content')
    <div class="app-title">
        <div>
          <h1><i class="fa fa-edit"></i>Manage All Student</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Home</li>
          <li class="breadcrumb-item"><a href="#">All Student</a></li>
        </ul>
    </div>
<div class="row justify-content-md-center">
    <div class="col-md-9">
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
                                <th>Name</th>
                                {{--  <th>Class</th>
                                <th>Section</th>
                                <th>Shift</th>  --}}
                                <th>Father</th>
                                <th>Mother</th>
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

        //$('#sessionYear').click(function (e) {
           // e.preventDefault();

       // var sessionYearId=$("#sessionYear").val();
           // console.log(sessionYearId);
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
                ajax:"{{url('mystudent/list')}}",
                columns:[
                    {data: 'DT_RowIndex',name: 'DT_RowIndex'},
                    //{ data: 'studentId', name: 'studentId' },
                    { data: 'roll', name: 'roll' },
                    { data: 'firstName', name: 'firstName' },
                    //{ data: 'section.classes', name: 'section.classes' },
                   // { data: 'section.sectionName', name: 'section.sectionName'},
                   // { data: 'section.shift', name: 'section.shift'},
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
