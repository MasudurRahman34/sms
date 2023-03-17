@extends('backend.layouts.master')
	@section('title', 'Home Page')
    @section('content')
    {{-- //main content --}}
    <div class="app-title">
        <div>
          <h1><i class="fa fa-edit"></i> User And Role</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Home</li>
          <li class="breadcrumb-item"><a href="#">UserAndRole</a></li>
        </ul>
    </div>
      <div class="row">
      <div class="col-md-7">
            <div class="tile">
              <div class="tile-body">
{{-- {{Auth::user()->getPermissionsViaRoles('name')}} --}}
                <div class="table-responsive">
                <table class="table table-hover table-bordered" id="sampleTable">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Mobile</th>
                      <th>Email</th>
                      <th>Password</th>
                      <th>Role</th>
                      <th>Class</th>
                      <th>Section</th>
                      <th>Shift</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>

                  </tbody>
                </table>
              </div>
              </div>
            </div>
          </div>
          <div class="col-md-5">
                <div class="tile">
                 <form class="form-horizontal ml-5" id="myform" style="" method="post" action="javascript:void(0)">
                        @csrf
                  <h3 class="tile-title border-bottom p-2">Add New User</h3>
                  <div class="tile-body">

                      <div class="form-group row">
                        <label class="control-label col-md-3 pl-4 col-sm-12">Name</label>
                        <div class="col-md-9 col-sm-12">
                          <input class="form-control col-md-10 col-sm-12" type="text" id="name" name="name">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-12 pl-4">Mobile</label>
                        <div class="col-md-9 col-sm-12">
                          <input class="form-control col-md-10 col-sm-12" type="text" id="mobile" name="mobile">
                        </div>
                      </div>
                      <div class="form-group row">
                            <label class="control-label col-md-3 col-sm-12 pl-4">Email</label>
                            <div class="col-md-9 col-sm-12">
                              <input class="form-control col-md-10 col-sm-12" type="email" id="email" name="email">
                            </div>
                          </div>
                        <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-12 pl-4">Designation</label>
                                <div class="col-md-9 col-sm-12">
                                    <select id="designation" name="designation" class="col-md-10 form-control" required>
                                    <option>--Please Select---</option>
                                    <option value="Teacher">Teacher</option>
                                    <option value="Accountant">Accountant</option>
                                    <option value="Librarian">Librarian</option>
                                    <option value="Principal">Principal</option>
                                    <option value="Sr Pricipal">Sr Pricipal</option>
                                    <option value="Employee">Employee</option>

                                    </select>
                                </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3 col-sm-12 pl-4">Role</label>
                            <div class="col-md-9 col-sm-12">
                                    <select id="role" name="role" class="form-control col-md-10">
                                    <option>--Please Select---</option>
                                        @foreach ($roles as $role)
                                    <option value="{{$role->id}}">{{$role->name}}</option>

                                        @endforeach

                                    </select>
                            </div>
                        </div>

                        <div class="form-group row bg-light" hidden id="class">
                            <div class="col-md-12 col-sm-12 text-center mb-2 text-danger">
                                    Make Class Teacher To
                            </div>
                            <label class="control-label col-md-3 col-sm-12 pl-4">Shift</label>
                                <div class="col-md-9 col-sm-12">
                                    <div class="form-check">
                                        <label class="radio">
                                          <input type="radio" id="shift" name="shift" value="Morning" checked="" class="admission">
                                            Morning
                                        </label>
                                          &nbsp;
                                          <label class="radio">
                                            <input type="radio" id="shift" name="shift" value="Day" class="admission">
                                              Day
                                          </label>
                                          <label class="radio">
                                              <input type="radio" id="shift" name="shift" value="Evening" class="admission">
                                                Evening
                                            </label>


                                        </div>
                                </div>

                                <label class="control-label col-md-3 col-sm-12 pl-4">Session</label>
                                <div class="col-md-9 col-sm-12">
                                        <select id="sessionYear" name="sessionYear" class="form-control col-md-10 admission">
                                        <option>Select Session</option>
                                            @foreach (App\model\SessionYear::where('bId', Auth::guard('web')->user()->bId)->get() as $Session)
                                                <option value="{{$Session->id}}">{{$Session->sessionYear}}</option>
                                            @endforeach

                                        </select>
                                </div>
                                <label class="control-label col-md-3 col-sm-12 pl-4">Class</label>
                                <div class="col-md-9 col-sm-12">
                                        <select id="classId" name="classId" class="form-control col-md-10 admission">
                                        <option>Select Class</option>
                                            @foreach ($classes as $class)
                                            <option value="{{$class->id}}">{{$class->className}}</option>

                                            @endforeach

                                        </select>
                                </div>
                                <label class="control-label col-md-3 col-sm-12 pl-4">Section</label>
                                <div class="col-md-9 col-sm-12">
                                        <select id="sectionId" name="sectionId" class="form-control col-md-10 ">


                                        </select>
                                </div>
                            </div>

                        {{-- <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-12 pl-4">Joining Date</label>
                                <div class="col-md-9 col-sm-12">
                                    <input class="form-control col-md-10 col-sm-12" type="text" id="demoDate" name="joinDate">
                                </div>
                        </div>

                      <div class="form-group row">
                        <label class="control-label col-md-3 pl-4 col-sm-12">Address</label>
                        <div class="col-md-9 col-sm-12">
                          <textarea class="form-control col-md-10 col-sm-12" rows="4" id="address" name="address"></textarea>
                        </div>
                      </div> --}}


                  </div>
                  <div class="tile-footer">
                        <div class="row">
                          <div class="col-md-12 col-sm-12">
                            <button class="btn btn-primary" type="submit" id="submit" style="float: right;"><i class="fa fa-fw fa-lg fa-check-circle"></i>Submit</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="#"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                          </div>
                        </div>
                    </div>
                  </div>
                </div>
            </form>

      </div>
      <div class="clearix"></div>
    @endsection
    @section('script')
      @include('backend.partials.js.datatable');
      <script type="text/javascript" src="{{ asset('admin/js/plugins/select2.min.js') }}"></script>
      <script type="text/javascript" src="{{ asset('admin/js/plugins/bootstrap-datepicker.min.js') }}"></script>

      <script>

        //   $('#demoSelect').select2();
          $('#demoDate').datepicker({
            format: "dd/mm/yyyy",
            autoclose: true,
            todayHighlight: true
        });
        dynamicSectionSelection();
        // function checkRoleHasClassTeacher(){

        // }
        $('#role').change(function (e) {
            e.preventDefault();
            var role=$('#role').val();
            $.ajax({
                type: "get",
                url: "{{url('/api/roleHasClassTeacher')}}"+'/'+role,
                data: role,
                success: function (response) {
                    if(response>0){
                        $('#class').attr('hidden', false);
                    }else{
                        $('#class').attr('hidden', true);
                    }
                }
            });

        });



        var table= $('#sampleTable').DataTable({
                dom: 'lBfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                processing:true,
                serverSide:true,
                ajax:"{{url('/userAndRole/list')}}",
                columns:[
                    { data: 'hash', name: 'hash' },
                    { data: 'name', name: 'name' },
                    { data: 'mobile', name: 'mobile' },
                    { data: 'email', name: 'email' },
                    { data: 'readablePassword', name: 'readablePassword' },
                    { data: 'role', name: 'role' },
                    { data: 'class', name: 'class' },
                    { data: 'section', name: 'section' },
                    { data: 'shift', name: 'shift' },
                    { data: 'action', name: 'action' }
                ]
            });


        $(document).ready(function () {
            $('#submit').click(function (e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                });
                jQuery.ajax({
                    method: 'post',
                    url: "{{ url('/add/userAndRole') }}",
                    data: {
                    name: $('#name').val(),
                    mobile: $('#mobile').val(),
                    email: $('#email').val(),
                    designation: $('#designation option:selected').val(),
                    role: $('#role option:selected').val(),
                    shift: $('#shift:checked').val(),
                    sessionYearId: $('#sessionYear option:selected').val(),
                    classId: $('#classId option:selected').val(),
                    sectionId: $('#sectionId option:selected').val(),
                    joinDate: $('#demoDate').val(),
                    address: $('#address').val(),
                    },
                    success: function(result){
                    console.log(result);
                   if (result.success) {
                            $( "div" ).remove( ".text-danger" );
                            console.log(result);
                            successNotification();
                            removeUpdateProperty("Class");
                            document.getElementById("myform").reset();
                        }
                        if(result.errors){
                            getError(result.errors);
                        }else if(result.classTeacherError){
                            alert(result.classTeacherError);
                        }
                }, error: function(xhr, status, error){
                    var errorMessage = xhr.status + ': ' + xhr.statusText
                    alert('Error - ' + errorMessage);
            }
        });

    });
});
      </script>
    @endsection

