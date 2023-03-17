@extends('backend.layouts.master')
	@section('title', 'Subject Management ')
    @section('content')
    {{-- //main content --}}
    <div class="app-title">
        <div class="hmmm">
          <h1><i class="fa fa-edit"></i> Manage Subject</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Home</li>
          <li class="breadcrumb-item"><a href="#">Manage Subject</a></li>
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
                      <th>Class Name</th>
                      <th>Subject Name</th>
                      <th>Subject Code</th>
                      <th>Subject Type</th>
                      <th>Optional</th>
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
              <h3 class="tile-title border-bottom p-2" id="title"> Add Subject</h3>
            <div class="tile-body">
            <div class="form-group">
              
                  <label for="exampleSelect1">Select Class</label>
                  <select class="form-control" id="classId" name="classId" multiple="multiple">
                   @foreach ($class as $class)
                  <option value="{{$class->id}}">{{$class->className}}</option>
                   @endforeach

                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleSelect1">Subject Name</label>
                    <input class="form-control"  type="text" id="subjectName" name="subjectName" placeholder="Enter Subject Name">
                </div>
                <div class="form-group">
                  <label for="exampleSelect1">Subject Code</label>
                    <input class="form-control"  type="text" id="subjectCode" name="subjectCode" placeholder="Enter Subject Code">
                </div>

                <div class="form-group">
                    <fieldset class="form-group">
                        <legend >Subject Type</legend>
                        <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input"  type="radio" value="General" id="group" name="group" checked>General
                        </label>
                        &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                        <label class="form-check-label">
                            <input class="form-check-input"  type="radio"  value="Science" id="group" name="group" >Science
                        </label>
                        &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" value="Arts" id="group" name="group" >Arts
                        </label>
                        &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                        <label class="form-check-label">
                            <input class="form-check-input"type="radio"  value="Commerce" id="group" name="group" >Commerce
                        </label>
                        &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;

                        </div>
                    </fieldset>
                  </div>

                <div class="form-group">
                    <div class="animated-checkbox">
                        <label>
                            <input type="checkbox" value="1" id="optionalstatus" name="optionalstatus"><span class="label-text">optional</span>
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
          <!--End Form-->
        </div>
    </div>
    </div>
    <div class="clearix"></div>
    @endsection
    @section('script')
        @include('backend.partials.js.datatable');
        <script type="text/javascript" src="{{ asset('admin/js/plugins/select2.min.js') }}"></script>
<script>
  
  $('#classId').select2();
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
             ajax:"{{url('/subject/show')}}",
             columns:[
                 { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                 { data: 'classes.className', name: 'classes.className' },
                 { data: 'subjectName', name: 'subjectName' },
                 { data: 'subjectCode', name: 'subjectCode' },
                 { data: 'group', name: 'group' },
                 { data: 'optionalstatus', name: 'optionalstatus' },
                 { data: 'action', name: 'action' }
             ]
         });

          //update and submit

          $('#submit').click(function (e) {
                e.preventDefault();
                console.log($('#classId').val() || []);
                var id=$('#submit').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                });
                if (id>0) {
                   var url="{{url('subject/update')}}"+"/"+id;
               }else{
                   var url="{{url('/subject/store')}}"
               }
                jQuery.ajax({
                    method: 'post',
                    url: url,
                    data: {
                    //classId: $('#classId option:selected').val(),
                    classId:$('#classId').val() || [],
                    subjectName: $('#subjectName').val(),
                    subjectCode: $('#subjectCode').val(),
                    group: $('#group:checked').val(),
                    optionalstatus: $('#optionalstatus:checked').val(),
                    ca: $('#ca').val(),
                    mcq: $('#mcq').val(),
                    written: $('#written').val(),
                    practical: $('#practical').val(),
                    },
                    success: function(result){
                        if (result.success) {
                            $( "div" ).remove( ".text-danger" );
                            console.log(result);
                            successNotification();
                            removeUpdateProperty("subject");
                            document.getElementById("myform").reset();
                        }
                        if(result.errors){
                            getError(result.errors);
                        }
                }
            });
        });

        //edit view
        function editSubject(id) {

            setUpdateProperty(id, "subject");
            var url="{{url('/subject/edit')}}";
            $.ajax({
                type:'GET',
                url:url+"/"+id,
                success:function(data) {

                    $('#classId').val(data.classId);
                    $('#classId').trigger('change');
                    $('#subjectName').val(data.subjectName);
                    $('#subjectCode').val(data.subjectCode);
                    $('#ca').val(data.ca);
                    $('#mcq').val(data.mcq);
                    $('#written').val(data.written);
                    $('#practicle').val(data.practicle);
                    console.log(data);
                    $("input[name='group'][value='"+data.group+"']").prop('checked', true);
                    //$("input[name='optionalstatus'][value='"+data.optionalstatus+"']").prop('checked', true);

                    //for check and uncheck checkBox
                    if(data.optionalstatus==0){

                        $("input[name='optionalstatus']").prop("checked", false);
                    }else{

                        $("input[name='optionalstatus']").prop("checked", true);
                    }

            }
            });

        }

         //delete
         function deleteSubject(id) {
                var url = "{{url('/subject/delete')}}";
                deleteAttribute(url,id);
        }

</script>
  @endsection
