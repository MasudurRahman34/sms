@extends('backend.layouts.master')
	@section('title', 'Fee Management')
    @section('content')
    {{-- //main content --}}
    <div class="app-title">
        <div class="hmmm">
          <h1><i class="fa fa-edit"></i> Manage Fee List</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Home / Admin</li>
          <li class="breadcrumb-item"><a href="#">Manage Fee</a></li>
        </ul>
    </div>
    <div class="row">
    <div class="col-md-8">
            <div class="tile">
              <div class="tile-body">
                <div class="table-responsive">
                <table class="table table-hover table-bordered" id="sampleTable">
                  <thead>
                    <tr>
                      <th></th>
                      <th>Fee Name</th>
                      <th>type</th>
                      <th>Amount</th>
                      <th>Class</th>
                      <th>Taken In Admission</th>
                      <th>Taken Interval</th>
                      <th>Year</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-4">
        <form id="myform" action="javascript:void(0)">
        @csrf
            <div class="tile">
              <h3 class="tile-title border-bottom p-2" id="title"> Add Fee</h3>
            <div class="tile-body">

                <div class="form-group">
                    <label for="exampleSelect1">Fee Name</label>
                    <input class="form-control"  type="text" id="name" name="name" placeholder="Enter Fee Name">
                </div>
                <div class="form-group">
                    <label for="exampleSelect1">Amount</label>
                    <input class="form-control"  type="number" id="amount" name="amount" placeholder="Enter Fee Amount" min="10">
                </div>

                <div class="form-group">
                    <label for="exampleSelect1">Select Class</label>
                    <select class="form-control" id="classId" name="classId">
                    @foreach ($class as $class)
                        <option value="{{$class->id}}">{{$class->className}}</option>
                    @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleSelect1"> Taken Interval</label>
                        <select class="form-control" id="interval" name="interval">
                            <option value="monthly">Monthly</option>
                            <option value="yearly">Yearly</option>
                        </select>
                </div>
                <div class="form-group">
                    <label for="exampleSelect1">Session Year</label>

                    <select class="form-control" id="sessionYearId" name="sessionYearId">
                        @foreach ($sessionYear as $year)
                        <option value="{{$year->id}}"{{$year->status == 1 ? 'selected': ''}}>{{$year->sessionYear}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-row">
                    <label for="exampleSelect1">Is Taken During Admission</label>
                    <div class="form-check">
                        <label class="radio">
                            <input type="radio" id="status" name="status"  value="1" checked>
                            Yes
                        </label>
                        &nbsp;
                        <label class="radio">
                            <input type="radio"  id="status" name="status"  value="0">
                            No
                        </label>
                    </div>
                </div>

                <div class="form-row">
                    <label for="exampleSelect1">Fee Type</label>
                    <div class="form-check">
                        <label class="radio">
                            <input type="radio" id="type" name="type"  value="gov" checked>
                            Gov
                        </label>
                        &nbsp;
                        <label class="radio">
                            <input type="radio"  id="type" name="type"  value="nonGov">
                            non Gov
                        </label>
                    </div>
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

      //script section
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
         ajax:"{{url('/fee/show')}}",
         columns:[
             { data: 'DT_RowIndex', name: 'DT_RowIndex' },
             { data: 'name', name: 'name' },
             { data: 'type', name: 'type' },
             { data: 'amount', name: 'amount' },
             { data: 'classes.className', name: 'classes.className' },
             { data: 'status', name: 'status' },
             { data: 'interval', name: 'interval' },
             { data: 'sessionYearId', name: 'sessionYearId' },
             { data: 'action', name: 'action' },
         ]
     })


    //update and submit option
    $('#submit').click(function (e) {
        e.preventDefault();
        var id=$('#submit').val();
        console.log(id);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
        });
        if (id>0) {
           var url="{{url('fee/update')}}"+"/"+id;
       }else{
           var url="{{url('/fee/store')}}"
       }
        jQuery.ajax({
            method: 'post',
            url: url,
            data: {
                name: $('#name').val(),
                amount: $('#amount').val(),
                classId: $('#classId option:selected').val(),
                interval: $('#interval option:selected').val(),
                sessionYearId: $('#sessionYearId option:selected').val(),
                status: $('#status:checked').val(),
                type: $('#type:checked').val(),
            },
            success: function(result){
                if (result.success) {
                    $( "div" ).remove( ".text-danger" );
                    console.log(result);
                    successNotification();
                    removeUpdateProperty("fee");
                    document.getElementById("myform").reset();
                }
                if(result.errors){
                    getError(result.errors);
                }
        }
    })
});

    //edit view option
    function editfee(id) {

        setUpdateProperty(id, "fee");
        var url="{{url('/fee/edit')}}";
        $.ajax({
            type:'GET',
            url:url+"/"+id,
            success:function(data) {

                $('#classId').val(data.classId);
                $('#name').val(data.name);
                $('#amount').val(data.amount);
                $('#interval').val(data.interval);
                $('#sessionYearId').val(data.sessionYearId);
                console.log(data);
                $("input[name='type'][value='"+data.type+"']").prop('checked', true);
                $("input[name='status'][value='"+data.status+"']").prop('checked', true);


        }
        });

    }

    //delete option
     function deletefee(id) {
        var url = "{{url('/fee/delete')}}";
        //deleteAttribute(url,id);
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this file!",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel plx!",
            closeOnConfirm: false,
            closeOnCancel: true,
        }, function(isConfirm) {
            if (isConfirm) {
              $.ajax({
                  url:url+"/"+id,
                  type:"GET",
                  dataType:"json",
                  success:function(data) {
                      if(data.error){
                       swal("Sorry",data.error , "error");
                      console.log(data.error);
                      }if(data.success){
                       table.draw();
                       swal(data.success);
                      }
                  }
              })

            } else {
                swal("Cancelled", "Your data is safe :)", "error");
            }
        });


    }

    </script>
    @endsection
