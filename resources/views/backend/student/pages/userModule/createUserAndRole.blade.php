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
                      <th>SL</th>
                      <th>Name</th>
                      <th>Mobile</th>
                      <th>Email</th>
                      <th>Role</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($Users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->mobile}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                @foreach ($user->roles as $role)
                                    {{$role->name}}
                                @endforeach
                            </td>
                          </tr>
                      @endforeach

                  </tbody>
                </table>
              </div>
              </div>
            </div>
          </div>
          <div class="col-md-5">
                <div class="tile">
                 <form class="form-horizontal ml-5" style="" method="post" action="{{ url('/add/userAndRole') }}">
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
                                  <input class="form-control col-md-10 col-sm-12" type="text" id="designation" name="designation">
                                </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3 col-sm-12 pl-4">Role</label>
                            <div class="col-md-9 col-sm-12">
                                    <select id="demoSelect" name="role" class="control">
                                        @foreach ($roles as $role)
                                    <option value="{{$role->id}}">{{$role->name}}</option>

                                        @endforeach

                                    </select>
                            </div>
                        </div>
                        <div class="form-group row">
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
                      </div>


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
          $('#demoSelect').select2();
          $('#demoDate').datepicker({
            format: "dd/mm/yyyy",
            autoclose: true,
            todayHighlight: true
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
                    designation: $('#designation').val(),
                    role: $('#demoSelect option:selected').val(),
                    joinDate: $('#demoDate').val(),
                    address: $('#address').val(),
                    },
                    success: function(result){
                    console.log(result);
                    if(result.errors){
                        $( "div" ).remove( ".text-danger" );
                            for (err in result.errors) {
                            $('<div>'+result.errors[err]+'</div>').insertAfter('#'+err).addClass('text-danger').attr('id','error');
                            console.log(err);
                            }
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

