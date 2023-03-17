@extends('backend.layouts.master')
	@section('title', 'Group Management')
    @section('content')
    {{-- //main content --}}
    <div class="app-title">
        <div>
          <h1><i class="fa fa-edit"></i>Manage Group</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Home</li>
          <li class="breadcrumb-item"><a href="#">Manage Group</a></li>
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
                                <th></th>
                                <th>Group Name</th>
                                <th>Created Date</th>
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
            <div class="tile">
                <h3 class="tile-title border-bottom p-2" id="title">Add Group</h3>

                <div class="tile-body">
                {{-- <div class="form-group row">
                  <label for="exampleSelect1" class="control-label col-md-3 pl-4">Select Class</label>
                  <select class="form-control col-md-7"  id="classId" name="classId">
                   @foreach ($class as $class)
                  <option value="{{$class->id}}">{{$class->className}}</option>
                   @endforeach

                  </select>
                </div> --}}
                        <div class="form-group row">
                            <label class="control-label col-md-3 pl-4"> Group Name</label>
                            <div class="col-md-9">
                                <input class="form-control col-md-10" type="text" id="group" value="" name="group">
                            </div>
                        </div>
                </div>
                <div class="tile-footer">
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-primary edit_studClass"  style="float: right;" id="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Submit</button>
                        </div>
                    </div>
                </div>
            </div>
            </form>
            <!--End section-->
        </div>

    </div>

      <div class="clearix"></div>
    @endsection
    @section('script')
    @include('backend.partials.js.datatable');
    <script>
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
                ajax:"{{url('group/show')}}",
                columns:[
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    // { data: 'classes.className', name: 'classes.className' },
                    { data: 'group', name: 'group' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'action', name: 'action' }
                ]
            });

            $('#submit').click(function(e) {
                e.preventDefault();
                var id=$('#submit').val();
                $.ajaxSetup({
               headers: {
                   'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                   },
               });
               if (id>0) {
                   var url="{{url('group/update')}}"+"/"+id;
               }else{
                   var url="{{url('/group/store')}}"
               }
                $.ajax({
                    type: "post",
                    url: url,
                    data: {
                    group: $('#group').val(),
                    },
                    success: function (result) {
                        if (result.success) {
                        $( "div" ).remove( ".text-danger" );
                        console.log(result);
                        successNotification();
                        removeUpdateProperty("Group");
                        document.getElementById("myform").reset();
                    }
                    if(result.errors){
                            getError(result.errors);
                        }
                    }

                });
            });
            //edit view
            function editGroup(id)
            {
                setUpdateProperty(id, "Group");
                var url="{{url('/group/edit')}}";
                $.ajax({
                    type:'GET',
                    url:url+"/"+id,
                    success:function(data) {
                        $('#classId').val(data.classId);
                        $('#group').val(data.group);
                        console.log(data);

                        }
                     });
             }
            //delete
            function deleteGroup(id) {
                var url = "{{url('/group/delete')}}";
                deleteAttribute(url,id);
        }


    </script>

    @endsection
