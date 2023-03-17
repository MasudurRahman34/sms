@extends('backend.layouts.master')
	@section('title', 'User profile')
    @section('content')
    <div class="row user">
        <div class="col-md-3">
            <div class="card text-white bg-dark text-center" style="">
                <div class="card-content">
                    <div class="card-body">
                        @foreach($user->file as $fill)
                            @if($fill->type=="profile")
                                <img class="rounded mx-auto d-block" src="{{asset('users/'.$fill->image)}}" style="width: 50%; height: 50%;">
                            @endif
                        @endforeach
                        <hr>
                        <h5 class="text-info">{{$user->name}}</h5>
                        <h4>{{$user->designation}}</h4>
                    </div>
                </div>
            </div>
            <div class="tile p-0">
              <ul class="nav flex-column nav-tabs user-tabs">
                @if(Auth::guard('web')->user()->id=$editId)
                 <li class="nav-item"><a class="nav-link" href="{{route('user.show', [$editId])}}"> Show Profile</a></li>
                @endif
              </ul>
            </div>
        </div>
       
    <div class="col-md-9">
      <div class="">
        <div class="tile">
          <div class="tile-body">

              <h2>User Update Information</h2>
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
                @if(Session::has('error'))
                <div class="alert alert-danger" role="alert">
                    {{ Session::get('error') }}
                 </div>
               @endif
                 <br>
              <!-- Nav tabs -->
              <ul class="nav nav-tabs">
                <li class="nav-item">
                  <a class="nav-link active" href="#home">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#menu2">Change Password</a>
                </li>
                @can('User Management')
                @if(Auth::guard('web')->user()->id!=$editId)
                <li class="nav-item">
                    <a class="nav-link" href="#role">Change Role</a>
                  </li>

              @endif
              @endcan
            </ul>

              <!-- Tab panes -->
              <div class="tab-content">
                <div id="home" class="container tab-pane active"><br>
                  <h4>Update User Information</h4>
                  <hr>
                  <div class="row">
                      <form class="row" action="{{route('userUpdate.profile', [$editId])}}" method="post" enctype="multipart/form-data">
                      @csrf
                         <div class="form group col-md-3">
                            <label class="control-label">Name</label>
                            <input class="form-control" type="text" name="name" value="{{$user->name}}">
                          </div>
                          <div class="form group col-md-3">
                            <label class="control-label">Email</label>
                            <input class="form-control" type="text" name="email" value="{{$user->email}}">
                          </div>
                          <div class="form group col-md-3">
                            <label class="control-label">Mobile</label>
                            <input class="form-control" type="text" name="mobile"
                              id="studentname" value="{{$user->mobile}}">
                          </div>
                          <div class="form group col-md-3">
                            <label class="control-label">Designation</label>
                            <input class="form-control" type="text" name="designation" value="{{$user->designation}}">
                          </div>
                          <div class="form-group col-md-3">
                            <label class=" control-label">JoinDate</label>
                            <div class="">
                              <input class="form-control" type="date" name="joinDate" value="{{$user->joinDate}}">
                            </div>
                          </div>
                          <div class="form group col-md-3">
                            <label class="control-label">Address</label>
                            <input class="form-control" type="text" name="address" value="{{$user->address}}">
                          </div>

                          <div class="form group col-md-3">
                            <label class="control-label">Skill</label>
                            <input class="form-control" type="text" name="skill" value="{{$user->skill}}">
                          </div>
                          <div class="form group col-md-3">
                            <label class="control-label">Educattion</label>
                            <input class="form-control" type="text" name="educattion" value="{{$user->educattion}}">
                          </div>
                          <div class="form group col-md-3">
                            <label class="control-label">Biography</label>
                            <input class="form-control" type="text" name="biography" value="{{$user->biography}}">
                          </div>
                          <div class="form-group col-md-3">
                              <lable class="">Change Image</lable>
                              <input type="file" name="image" class="form-control btn btn-light" id="file">
                          </div>
                          <div class="form-group col-md-3">
                              <lable class="">Preview Image</lable>
                              <img id="image_preview" src="" style="width: 180px;height: 180px">
                          </div>
                          <!-- <div class="form group col-md-3">
                            <label class="control-label">Resume</label>
                            <input class="form-control" type="file" name="resume" value="{{$user->resume}}">
                          </div>
                          <div class="form group col-md-3">
                            <label class="control-label">Certificate</label>
                            <input class="form-control" type="file" name="certificate" value="{{$user->certificate}}">
                          </div> -->
                          <div class="form group col-md-3" hidden>
                            <label class="control-label">bId</label>
                            <input class="form-control" type="text" name="bId" value="{{$user->bId}}" readonly>
                          </div>

                      </div>
                      <div class="tile-footer">
                      <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Update Profile</button>
                    </div>
                </div>
                 </form>
                 <!-- change Password -->
            <div id="menu2" class="container tab-pane fade"><br>
             <form action="{{route('userChange.password',  [$editId])}}" method="post">
               @csrf
                <div class="row">
                  <div class="form group col-md-3">
                    <label class="control-label">Old Password</label>
                       <input type="password" class="form-control" name="old_password" id="old_password">
                    </div>
                    <div class="form group col-md-3">
                      <label class="control-label">New Password</label>
                      <input type="password" class="form-control" name="password" id="password">
                    </div>
                    <div class="form group col-md-3">
                      <label class="control-label">Confirm Password</label>
                      <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
                    </div>
                </div>
                <div class="tile-footer">
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Update Password</button>
                </div>
            </form>
            </div>
            @can('User Management')
            @if(Auth::guard('web')->user()->id!=$editId)
            <div id="role" class="container tab-pane fade"><br>
                <form action="{{route('updateRole', [$editId])}}" method="post">
                  @csrf
                   <div class="row">
                       <div class="form group col-md-3">
                         <label class="control-label">Current Role</label>
                         <input type="text" name="currentRole" value="{{$user->getRoleNames()}}" checked="" class="admission" readonly>
                       </div>
                       <div class="form group col-md-5">
                         <label class="control-label">Change To</label>
                         <select class="form-control" name="role" id="role" required>
                            <option value="0">--Please Select--</option>

                            @foreach (Spatie\Permission\Models\Role::where('bId', Auth::guard()->user()->bId)->get() as $Role)
                            <option value="{{$Role->id}}"> {{$Role->name}}</option>
                        @endforeach
                        </select>
                       </div>
                       <div class="form-group row bg-light" hidden id="class">
                        <div class="col-md-12 col-sm-12 text-center mb-2 text-danger">
                                Make Class Teacher To
                        </div>
                        <div class="form-group col-md-3">
                        <label class="control-label">Shift</label>
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
                            <div class="form-group col-md-3">
                                <label class="control-label">Session</label>
                                    <select id="sessionYear" name="sessionYear" class="form-control admission">
                                    <option>Select Session</option>
                                        @foreach (App\model\SessionYear::where('bId', Auth::guard('web')->user()->bId)->get() as $Session)
                                            <option value="{{$Session->id}}">{{$Session->sessionYear}}</option>
                                        @endforeach
                                    </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">Class</label>
                                    <select id="classId" name="classId" class="form-control col-md-10 admission">
                                        <option>Select Class</option>
                                            @foreach (App\model\classes::where('bId', Auth::guard('web')->user()->bId)->get() as $class)
                                            <option value="{{$class->id}}">{{$class->className}}</option>
                                            @endforeach
                                    </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">Section</label>
                                <select id="sectionId" name="sectionId" class="form-control col-md-10 ">
                                </select>
                            </div>
                   </div>
                   </div>
                   <div class="tile-footer">
                       <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Update Role</button>
                   </div>
               </form>
               </div>
               @endif
               @endcan
            </div>

            </div>
        </div>
    </div>
    </div>
</div>
</div>
</div>
    <!--End Row-->
  </main>

      <div class="clearix"></div>
    @endsection
    @section('script')
      {{-- @include('backend.partials.js.datatable'); --}}
      <script>
      $(document).ready(function(){
        $(".nav-tabs a").click(function(){
          $(this).tab('show');
        });
      });
      //image preview
      $(document).ready(function(){
          $(".nav-tabs a").click(function(){
              $(this).tab('show');
          });
      });

      function readURL(input) {
          if (input.files && input.files[0]) {
              var reader = new FileReader();
              reader.onload = function(e) {
                  $('#image_preview').attr('src', e.target.result);
              }
              reader.readAsDataURL(input.files[0]);
          }
      }
      $("#file").change(function() {
          readURL(this);
      });

      //when image upload
      $("#file").change(function () {
          if(fileExtValidate(this)) { // file extension validation function
              if(fileSizeValidate(this)) { // file size validation function
                  showImg(this);
              }
          }
      });
      // function for  validate file extension
      var validExt = ".png, .gif, .jpeg, .jpg";
      function fileExtValidate(fdata) {
          var filePath = fdata.value;
          var getFileExt = filePath.substring(filePath.lastIndexOf('.') + 1).toLowerCase();
          var pos = validExt.indexOf(getFileExt);
          if(pos < 0) {
              $('input[type=file]').val(null);
              alert("This file is not allowed, please upload valid file.");
              return false;

          } else {
              return true;
          }
      }
      //function for validate file size
      var maxSize = 100;
      function fileSizeValidate(fdata) {
          if (fdata.files && fdata.files[0]) {
              var fsize = fdata.files[0].size/100;
              if(fsize > maxSize) {
                  $('input[type=file]').val(null);
                  alert('Maximum file size exceed, This file size is: ' + fsize + "KB. You need 100 KB");
                  return false;
              } else {
                  return true;
              }
          }
      }
      dynamicSectionSelection();
      //check role has class teacher
      $('#role').change(function (e) {
            e.preventDefault();
            var role=$('#role option:selected').val();
            console.log(role);
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
      </script>
@endsection
