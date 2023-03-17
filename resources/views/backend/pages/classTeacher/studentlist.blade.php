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
                                <th>Gender</th>
                               <th>Religion</th>
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
    //dynamicSectionSelection();
    $(document).ready(function (){


        var sectionId = {{$sectionId}};

        var classId ={{$classId}};

        var sessionYearId = {{$sessionYearId}};

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

        ajax:"{{url('myclass/sectionwiselist/')}}"+'/'+classId+'/'+sectionId+'/'+sessionYearId,
        columns:[
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
           // { data: 'studentId', name: 'studentId' },

            { data: 'roll', name: 'roll' },
            { data: 'firstName', name: 'firstName' },
            { data: 'gender', name: 'gender' },
         { data: 'religion', name: 'religion'},
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
//  function deleteStudent(id) {
//     var url = "{{url('myclass/student/delete/')}}";
//     deleteAttribute(url,id);
// }

    </script>

    @endsection
