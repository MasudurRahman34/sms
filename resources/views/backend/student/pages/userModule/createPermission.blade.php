@extends('backend.layouts.master')
	@section('title', 'Home Page')
    @section('content')
    {{-- //main content --}}
    <div class="app-title">
        <div>
          <h1><i class="fa fa-edit"></i> Manage Permission</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Home</li>
          <li class="breadcrumb-item"><a href="#">Manage Permission</a></li>
        </ul>
    </div>
      <div class="row">
      <div class="col-md-5 col-sm-12">
        <div class="tile">
          <h3 class="tile-title border-bottom p-2">Add New Permission</h3>
          <div class="tile-body">
            <form class="form-horizontal ml-5">
              <div class="form-group row">
                <label class="control-label col-md-3 pl-4 col-sm-12"> Permission Name</label>
                <div class="col-md-9 col-sm-12">
                  <input class="form-control col-md-10 col-sm-12" type="text" id="permissionName" name="permissionName">
                </div>
              </div>
              <div class="form-group row">
                <label class="control-label col-md-3 col-sm-12 pl-4">Assing To Role</label>
                <div class="col-md-9 col-sm-12">
                        <select class="pr-5"  multiple="" id="role" >
                            @foreach ($roles as $role)
                                <option value="{{$role->id}}" class="form-control">{{$role->name}}</option>
                            @endforeach
                        </select>
                </div>
              </div>
          </div>
          <div class="tile-footer">
                <div class="row">
                  <div class="col-md-12 col-sm-12">
                    <button class="btn btn-primary" type="" style="float: right;" id="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Submit</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="#"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                  </div>
                </div>
            </div>
        </form>
          </div>
        </div>
        <div class="col-md-7 col-sm-12">
                <div class="tile">
                        <h3 class="tile-title border-bottom p-2">Permission List</h3>
                        <div class="tile-body">
                                <div class="animated-checkbox">
                            <div class="row">

                                <div class="col-md-12">
                                    <div style="min-height:100px">


                                    @foreach ($prms as $prm)
                                    <label class="pr-5">
                                            <input type="checkbox"  value=""><span class="label-text">{{$prm->name}}</span>
                                        </label><br>


                                    @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        </div>
      </div>

      <div class="clearix"></div>
    @endsection
    @section('script')

      <script type="text/javascript" src="{{ asset('admin/js/plugins/select2.min.js') }}"></script>
    <script>
        $('#role').select2();
        $(document).ready(function () {
            $('#submit').click(function (e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                var name=$(permissionName).val();
                jQuery.ajax({
                    method: 'post',
                    url: "{{ url('/addPermission') }}",
                    data: {
                    permissionName: $('#permissionName').val(),
                    role: $('#role option:selected').val(),

                    },
                    success: function(result){
                        swal({
                        title: "Thank You !",
                        text: "Permission Added !",
                        type: "success",
                        confirmButtonText: "Ok !",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    }, function(isConfirm) {
                        if (isConfirm) {
                            window.location.reload();
                        }
                    });

                }});

            });
        });
      </script>

    @endsection
