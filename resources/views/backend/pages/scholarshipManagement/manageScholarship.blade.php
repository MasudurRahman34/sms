@extends('backend.layouts.master')
	@section('title', 'Scholarship Management')
    @section('content')
    {{-- //main content --}}
    <div class="app-title">
        <div>
          <h1><i class="fa fa-edit"></i> Student Scholarship Management</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Home</li>
          <li class="breadcrumb-item"><a href="#">Scholarship Management</a></li>
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
                                <th>Scholarship Name</th>
                                <th>Discount<span style="color: red;">(%)</span></th>
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
                <h3 class="tile-title border-bottom p-2" id="title">Add New Scholarship</h3>
                <div class="tile-body">
                        <div class="form-group row {{$errors->has('name') ? 'has-error' : ''}}">
                            <label class="control-label col-md-3 pl-4">Scholarship Name<span style="color: red;">*</span></label>
                            <div class="col-md-9">
                                <input class="form-control col-md-10" type="text" id="name" value="" name="name">
                                @if($errors->has('name'))
                                    <span class="help-block text-danger">
                                    {{$errors->first('name')}}
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row {{$errors->has('discount') ? 'has-error' : ''}}">
                            <label class="control-label col-md-3 pl-4">Discount (%)<span style="color: red;">*</span></label>
                            <div class="col-md-9">
                                <input class="form-control col-md-10" type="number" id="discount" name="discount" max="100">
                                @if($errors->has('discount'))
                                    <span class="help-block text-danger">
                                    {{$errors->first('discount')}}
                                    </span>
                                @endif
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
                ajax:"{{url('schoolarship/show')}}",
                columns:[
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'name', name: 'name' },
                    { data: 'discount', name: 'discount' },
                    { data: 'action', name: 'action' }
                ]
            });


        function deleteScholarship(id) {
            var url = "{{url('/schoolarship/delete')}}";
            deleteAttribute(url,id);
        }

        function editScholarship(id) {
            var editId=id;
            setUpdateProperty(editId, "Scholarship");
            $("#submit").val(id);
            var url="{{url('schoolarship/edit')}}";
            $.ajax({
                type:'GET',
                url:url+"/"+id,
                dataType:"json",
                success:function(data) {
                    $('#name').val(data.name);
                    $('#discount').val(data.discount);
             }
            });
        }
          //Store the data
          $('#submit').click(function (e) {
               e.preventDefault();
               var id=$('#submit').val();
               var discount=$('#discount').val();

               if (discount>100){
                   alert("discount must be less than or equal 100");
                   return;

               }
               $.ajaxSetup({
               headers: {
                   'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                   },
               });
               var data={
                   name:$('#name').val(),
                   discount:$('#discount').val(),
               };
               console.log(data);
               if (id>0) {
                   var url="{{url('schoolarship/update')}}"+"/"+id;
               }else{
                   var url="{{url('schoolarship/store')}}"
               }
               $.ajax({
                   method:"POST",
                   url: url,
                   data: data,
                   success:function (result) {
                    if (result.success) {
                            $( "div" ).remove( ".text-danger" );
                            console.log(result);
                            successNotification();
                            removeUpdateProperty("Scholarship");
                            document.getElementById("myform").reset();
                        }
                        if(result.errors){
                            getError(result.errors);
                        }
                }
            });

        });


    </script>

    @endsection
