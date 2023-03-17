@extends('backend.layouts.master')
	@section('title', 'Admin|| Find Student Section Wish')
    @section('content')
    <div class="app-title">
        <div>
          <h1><i class="fa fa-edit"></i>Section Wish Student</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Home</li>
          <li class="breadcrumb-item"><a href="#">ClassWise Student</a></li>
        </ul>
    </div>
<div class="row justify-content-md-center">
    <div class="clearix"></div>
        <div class="col-md-9">
            <div class="tile">
                <div class="tile-body">
                    <div class="row">

                        <div class="form-group col-md-3">
                            <label class="control-label mt-2">Shift</label><br>
                                <div class="custom-control shift-radio custom-control-inline">
                                    <input type="radio" name="shift" id="shift1" value="Morning" class="custom-control-input admission" checked>
                                    <label class="custom-control-label"  for="shift1">Morning</label>
                                </div>
                                <div class="custom-control shift-radio custom-control-inline">
                                    <input type="radio" name="shift" id="shift2" value="Day" class="custom-control-input admission">
                                    <label class="custom-control-label" for="shift2">Day</label>
                                </div>
                                <div class="custom-control shift-radio custom-control-inline">
                                    <input type="radio" name="shift" id="shift3" value="Evening" class="custom-control-input admission">
                                    <label class="custom-control-label" for="shift3">Evening</label>
                                </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="exampleFormControlSelect1">Session Year</label>
                            <select class="form-control admission" id="sessionYear" >
                                <option value="">--Please Select--</option>
                                @foreach ($sessionYear as $year)
                                    <option value="{{$year->id}}" {{$year->status == 1 ? 'selected': ''}}>{{$year->sessionYear}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="exampleFormControlSelect1">Select Class</label>
                            <select class="form-control admission" id="classId" name="classId">
                                <option value="">--Please Select--</option>
                                @foreach ($class as $class)
                                <option value="{{$class->id}}">{{$class->className}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="exampleFormControlSelect1"> Section</label>
                            <select class="form-control" id="sectionId">
                                <option value=""> --Please Select--  </option>
                            </select>
                        </div>
                    </div>
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
                                {{--  <th>St ID</th>  --}}
                                <th>Roll</th>
                                <th>Name</th>
                                {{--  <th>Roll</th>
                                <th>Class</th>
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
    var table="";
    dynamicSectionSelection();
    $('#sectionId').change(function (e) {
        e.preventDefault();

        var classId=$("#classId").val();
        var sectionId=$("#sectionId").val();
        var sessionYearId=$("#sessionYear").val();

        console.log(classId, sectionId, sessionYearId);

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
        ajax:"{{url('mystudent/sectionwiselist/')}}"+'/'+classId+'/'+sectionId+'/'+sessionYearId,
        columns:[
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
           // { data: 'studentId', name: 'studentId' },

            { data: 'roll', name: 'roll' },
            { data: 'firstName', name: 'firstName' },
            //{ data: 'className', name: 'className' },
           // { data: 'sectionName', name: 'sectionName'},
           // { data: 'shift', name: 'shift'},
            { data: 'fatherName', name: 'fatherName'},
            { data: 'motherName', name: 'motherName'},
            { data: 'blood', name: 'blood'},
            { data: 'birthDate', name: 'birthDate'},
            { data: 'mobile', name: 'mobile'},
            { data: 'action', name: 'action' }
        ]
    });
    //table.destroy();
    table=table2;

    });


 //delete
 function deleteStudent(id) {
    var url = "{{url('mystudent/student/delete')}}";
    deleteAttribute(url,id);
}

    </script>

    @endsection
