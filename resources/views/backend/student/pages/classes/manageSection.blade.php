@extends('backend.layouts.master')
	@section('title', 'Home Page')
    @section('content')
    {{-- //main content --}}
    <div class="app-title">
        <div class="hmmm">
          <h1><i class="fa fa-edit"></i> Manage Section</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Home</li>
          <li class="breadcrumb-item"><a href="#">Manage Section</a></li>
        </ul>
    </div>
    <div class="row">
    <div class="col-md-7">
            <div class="tile">
              <div class="tile-body">
                <div class="table-responsive">
                <table class="table table-hover table-bordered" id="sampleTable">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Class Name</th>
                      <th>Section</th>
                      <th>Study Shift</th>
                      <th>Session Year</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-5">
        <form id="myform" action="javascript:void(0)">
        @csrf
          <div class="tile">
              <h3 class="tile-title border-bottom p-2" id="title"> Add Study Section</h3>
            <div class="tile-body">

                <div class="form-group">
                  <label for="exampleSelect1">Select Class</label>
                  <select class="form-control" id="classId" name="classId">
                   @foreach ($class as $class)
                  <option value="{{$class->id}}">{{$class->className}}</option>
                   @endforeach

                  </select>
                </div>
                <div class="form-group">
                    <label for="exampleSelect1">Session Year</label>
                    <select class="form-control" id="sessionYearId" name="sessionYearId">
                     @foreach ($sessionYear as $year)
                    <option value="{{$year->id}}" >{{$year->sessionYear}}</option>
                     @endforeach

                    </select>
                  </div>
                <div class="form-group">
                  <label for="exampleSelect1">Section Name</label>
                    <input class="form-control"  type="text" id="sectionName" name="sectionName" placeholder="Enter Section Name">
                </div>

                      <legend type="hidden">Study Shift</legend>
                      <div class="form-check">
                      <label class="radio">
                        <input type="radio" id="shift" name="shift"  value="morning">
                          Morning
                      </label>
                        &nbsp;
                        <label class="radio">
                          <input type="radio"  id="shift" name="shift"  value="evening">
                            Evening
                        </label>
                      </div>

            </div>
            <div class="tile-footer">
                  <div class="row">
                    <div class="col-md-12">
                      <button class="btn btn-primary" type="submit" id="submit" style="float: right;"><i class="fa fa-fw fa-lg fa-check-circle"></i>Submit</button></a>
                      {{-- <input class="btn btn-primary" type="reset" style="float: right;"><i class="fa fa-fw fa-lg fa-check-circle"></i>Reset</button></a> --}}
                    </div>
                  </div>
              </div>
            </div>
          </form>
        </div>
    </div>
    </div>
    <div class="clearix"></div>
    @endsection
    @section('script')
      @include('backend.partials.js.datatable');
      <script>

        // $(document).ready( function () {
            var table= $('#sampleTable').DataTable({
                dom: 'lBfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
             processing:true,
             serverSide:true,
             ajax:"{{url('/section/show')}}",
             columns:[
                 { data: 'hash', name: 'hash' },
                 { data: 'classes.className', name: 'classes.className' },
                 { data: 'sectionName', name: 'sectionName' },
                 { data: 'shift', name: 'shift' },
                 { data: 'session_year.sessionYear', name: 'session_year.sessionYear' },
                 { data: 'action', name: 'action' }
             ]
         });


        //  });
         //update and submit

         $('#submit').click(function (e) {
                e.preventDefault();
                var id=$('#submit').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                });
                if (id>0) {
                   var url="{{url('section/update')}}"+"/"+id;
               }else{
                   var url="{{url('/section/store')}}"
               }
                jQuery.ajax({
                    method: 'post',
                    url: url,
                    data: {
                    sectionName: $('#sectionName').val(),
                    classId: $('#classId option:selected').val(),
                    sessionYearId: $('#sessionYearId option:selected').val(),
                    sectionName: $('#sectionName').val(),
                    shift: $('#shift:checked').val(),
                    },
                    success: function(result){
                        if (result.success) {
                            $( "div" ).remove( ".text-danger" );
                            console.log(result);
                            successNotification();
                            removeUpdateProperty("section");
                            document.getElementById("myform").reset();
                        }
                        if(result.errors){
                            getError(result.errors);
                        }
                }
            });
        });
    //edit view


    function editSection(id) {
         var editId=id;
         setUpdateProperty(editId, "section");
         var url="{{url('/section/edit')}}";
         $.ajax({
             type:'GET',
             url:url+"/"+id,
             success:function(data) {

                 $('#classId').val(data.classId);
                 $('#sectionName').val(data.sectionName);
                 $('#sessionYearId').val(data.sessionYearId);
                 console.log(data);
                 $("input[name='shift'][value='"+data.shift+"']").prop('checked', true);
                 //$('#shift').val('"+data.shift+"').prop('checked', true);
          }
         });

     }

     function deleteSection(id) {
        var url = "{{url('/section/delete')}}";
        deleteAttribute(url,id);

    }

    </script>

    @endsection
