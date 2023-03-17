@extends('backend.layouts.master')
	@section('title', 'Exam Management ')
    @section('content')
    {{-- //main content --}}
    <div class="app-title">
        <div class="hmmm">
          <h1><i class="fa fa-edit"></i> Manage Exam</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Home</li>
          <li class="breadcrumb-item"><a href="#">Manage Exam</a></li>
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
                      <th>Exam Name</th>
                      <th>Exam Code</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-5">
        <!--Start form-->
        <form id="myform" action="javascript:void(0)">
        @csrf
          <div class="tile">
              <h3 class="tile-title border-bottom p-2" id="title"> Add Exam </h3>
            <div class="tile-body">
                <div class="form-group">
                  <label for="exampleSelect1">Exam Name</label>
                    <input class="form-control"  type="text" id="examName" name="examName" placeholder="Enter Exam Name">
                </div>
                <div class="form-group">
                  <label for="exampleSelect1">Exam Code</label>
                    <input class="form-control"  type="text" id="examCode" name="examCode" placeholder="Enter Exam Code">
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
          <!--End Form-->
        </div>
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

                    visible: false
                } ],
             processing:true,
             serverSide:true,
             ajax:"{{url('/exam/show')}}",
             columns:[
                 { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                 { data: 'examName', name: 'examName' },
                 { data: 'examCode', name: 'examCode' },
                 { data: 'action', name: 'action' }
             ]
         });

          //update and submit

          $('#submit').click(function (e) {
                e.preventDefault();

                var id=$('#submit').val();
                var examName= $('#examName').val();
                  var  examCode= $('#examCode').val();
                  //console.log(examName,examCode);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                });
                if (id>0) {
                   var url="{{url('exam/update')}}"+"/"+id;
               }else{
                   var url="{{url('/exam/store')}}"
               }

               //ajax
                jQuery.ajax({
                    method: 'post',
                    url: url,
                    data: {
                    examName: examName,
                    examCode: examCode,
                    },
                    success: function(result){
                        if (result.success) {
                            $( "div" ).remove( ".text-danger" );
                            //console.log(result);
                            successNotification();
                            removeUpdateProperty("exam");
                            document.getElementById("myform").reset();
                        }
                        if(result.errors){
                            getError(result.errors);
                        }
                }
            });

            //end
        });

        //edit view
        function editExam(id) {
            setUpdateProperty(id, "exam");
            var url="{{url('/exam/edit')}}";
            $.ajax({
                type:'GET',
                url:url+"/"+id,
                success:function(data) {
                    $('#examName').val(data.examName);
                    $('#examCode').val(data.examCode);
                    //console.log(data);
            }
            });
        }

         //delete
         function deleteExam(id) {
                var url = "{{url('/exam/delete')}}";
                deleteAttribute(url,id);
        }

</script>
  @endsection
