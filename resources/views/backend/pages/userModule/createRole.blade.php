@extends('backend.layouts.master')
	@section('title', 'Home Page')
    @section('content')
    {{-- //main content --}}
    <div class="app-title">
        <div>
          <h1><i class="fa fa-edit"></i> Manage Role</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Home</li>
          <li class="breadcrumb-item"><a href="#">Manage Role</a></li>
        </ul>
    </div>
      <div class="row">
        <div class="col-md-7 col-sm-12">
            <div class="tile">
                    <h3 class="tile-title border-bottom p-2">Role With Permission</h3>
                    <div class="tile-body">
                            <div class="animated-checkbox">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="tile">
                                    <div class="tile-body">
                                      <div class="table-responsive">
                                      <table class="table table-hover table-bordered" id="sampleTable">
                                        <thead>
                                          <tr>
                                            <th></th>
                                            <th>Role Name</th>
                                            <th>Permissions</th>
                                            <th>Action</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($roles as $role)
                                            <tr>
                                                <td></td>
                                                <td>{{$role->name}}</td>
                                                    <td>
                                                    <div class="bs-component">
                                                        @foreach ($role->permissions as $roleprm)
                                                            <button class="btn btn-warning btn-sm" type="button">{{$roleprm->name}}</button>
                                                        @endforeach
                                                    </div>
                                                </td>
                                                <td><button class="btn btn-info btn-sm" onClick="editRolePermission({{$role->id}})"><i class="fa fa-edit"></i></button></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                      </table>
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      <div class="col-md-5 col-sm-12">
        <div class="tile">
          <h3 class="tile-title border-bottom p-2">Add New Role</h3>
          <div class="tile-body">
            <form class="form-horizontal ml-5" style="font-size: 1rem;";
            font-weight: 400;">
              <div class="form-group row">
                <label class="control-label col-md-3 col-sm-12"> Role Name</label>
                <div class="col-md-9 col-sm-12">
                  <input class="form-control col-md-10 col-sm-12" type="text" id="roleName" name="roleName" required>
                </div>
              </div>
              <div class="form-group row">
                <label class="control-label col-md-12 col-sm-12 text-primary">Assign Permissions :</label>

                <div class="col-md-12 col-sm-12">
                    <div class="row">

                    @foreach ($prms as $prm)
                    @if($prm->id % 2==0)
                    <div class="col-md-6">
                        <label class="pr">
                            <input type="checkbox"  value="{{$prm->id}}" id="permissions" name="permissions" class="permissions" required><span class="label-text">{{$prm->name}}</span>
                        </label>
                    </div>
                    @else
                    <div class="col-md-6">
                            <label class="pr">
                                <input type="checkbox"  value="{{$prm->id}}" id="permissions" name="permissions" class="permissions"  required><span class="label-text" >{{$prm->name}}</span>
                            </label>
                        </div>
                    @endif
                    @endforeach

                    </div>
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


      <div class="clearix"></div>
    @endsection
    @section('script')
    <script type="text/javascript" src="{{ asset('admin/js/plugins/select2.min.js') }}"></script>
    @include('backend.partials.js.datatable');

      <script>
        $(document).ready(function () {
            $('#submit').click(function (e) {
                e.preventDefault();
                var submitValue=$(this).val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                var permission = [];
            $.each($("input[name='permissions']:checked"), function(){
                permission.push($(this).val());
            });


            console.log(permission);
                var roleName=$('#roleName').val();
                console.log(name);
                var url='';

                if(submitValue>0){
                    url="{{route('updateRolePermission')}}";
                }else{
                    url="{{ route('addRole') }}";
                }
                jQuery.ajax({
                    method: 'post',
                    url: url,
                    data: {
                        roleName: roleName,
                        permissions: permission,
                        roleId:submitValue,

                    },
                    success: function(result){
                        console.log(result);
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

                    console.log(result);
                }});

            });
        });
        function editRolePermission(id) {
            var editId=id;
            $('#submit').val(editId);
            var editId=id;
            setUpdateProperty(editId, "Role");
            $("#submit").val(id);
            var url="{{route('editRolePermission')}}";
            $.ajax({
                type:'GET',
                url:url,
                data:{
                    id:id,
                },
                success:function(data) {
                    console.log(data);
                   data.roles.forEach(role => {
                       $('#roleName').val(role.name);
                       $("input[name='permissions']").prop('checked', false);
                        role.permissions.forEach(permission => {
                            $("input[name='permissions'][value='"+permission.id+"']").prop('checked', true);
                        });
                   });
                }
            });
        }
      </script>

    @endsection
