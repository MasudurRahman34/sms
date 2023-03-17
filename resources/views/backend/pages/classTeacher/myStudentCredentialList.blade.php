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
    <div class="col-md-10">
        <div class="tile">
                <div class="tile-body">
                  @if(count($errors)>0)
                            <div class="alert alert-danger" role="alert">
                              <ul>
                                @foreach($errors->all() as $error)
                                  <li>{{ $error }}</li>
                                @endforeach
                              </ul>
                            </div>
                          @endif
                          @if(Session::has('success'))
                            <div class="alert alert-success" role="alert">
                                {{ Session::get('success') }}
                            </div>
                            @endif
                            @if(Session::has('failed'))
                            <div class="alert alert-danger" role="alert">
                                {{ Session::get('failed') }}
                              </div>
                            @endif
                            <br>
                    
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>ID</th>
                                <th>Roll</th>
                                <th>Name</th>
                                <th>Class</th>
                                <th>Section</th>
                                <th>Shift</th>  
                                 {{--  <th>Father</th>
                                <th>Mother</th>--}}
                                {{-- <th>Blood Group</th>
                                <th>Date of Birth</th> --}}
                                <th>Mobile</th>
                                <th>password</th>
                                <th>Change password</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

      <div class="clearix"></div>
  <!-- The Modal -->
  <div class="modal" id="newModal" >
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Fee Collection</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
           <form action="{{route('mystudent.change.password')}}" method="post">
               @csrf
               <input type="text" name="stdID" id="stdID" hidden>
                    <div class="row">
                      <div class="form group col-md-4">
                        <label class="control-label">Old Password</label>
                           <input type="password" class="form-control" name="old_password" required id="old_password">
                      </div>
                      <div class="form group col-md-4">
                          <label class="control-label">New Password</label>
                          <input type="password" class="form-control" name="password" required id="password">
                      </div>
                      <div class="form group col-md-4">
                          <label class="control-label">Confirm Password</label>
                          <input type="password" class="form-control" name="password_confirmation"  required  id="password_confirmation">
                      </div>
                    </div>
                    
           

        <!-- Modal footer -->
            <div class="modal-footer">
              <button type="submit" class="btn btn-success" id="update" >Update Password</button>
              <button type="button" class="btn btn-danger" id="cancel" data-dismiss="modal">Close</button>
            </div>
         </form>
        </div>

      </div>
    </div>
  </div>

    @endsection
    @section('script')
      @include('backend.partials.js.datatable');
      <script>

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
                ajax:"{{url('myclass/credential/list')}}"+'/'+classId+'/'+sectionId+'/'+sessionYearId,
                columns:[
                    {data: 'DT_RowIndex',name: 'DT_RowIndex'},
                    { data: 'studentId', name: 'studentId' },
                    { data: 'roll', name: 'roll' },
                    { data: 'firstName', name: 'firstName' },
                    { data: 'className', name: 'section.classes' },
                   { data: 'sectionName', name: 'section.sectionName'},
                   { data: 'shift', name: 'section.shift'},
                    //{ data: 'fatherName', name: 'fatherName'},
                    //{ data: 'motherName', name: 'motherName'},
                    // { data: 'blood', name: 'blood'},
                    // { data: 'birthDate', name: 'birthDate'},
                    { data: 'mobile', name: 'mobile'},
                    { data: 'readablePassword', name: 'readablePassword'},
                    { data: 'action', name: 'action' }
                ]
            });
       // });

        //delete
        function deleteStudent(id) { 
            var url = "{{url('mystudent/student/delete')}}";
            deleteAttribute(url,id);
    }
    function myFunction(id){
        var studentId=id
        console.log(studentId);
        $("#stdID").attr('value',studentId);

         var studentID= $("#stdID").val();
         console.log(studentID);
         $("#newModal").modal("show");
    }

// $('#modelid').click(function () {
//      $("#newModal").modal("show");
//      });

    </script>

    @endsection
