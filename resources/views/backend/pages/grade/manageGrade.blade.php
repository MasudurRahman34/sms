@extends('backend.layouts.master')
	@section('title', 'Grade Management ')
    @section('content')
    {{-- //main content --}}
    <div class="app-title">
        <div class="hmmm">
          <h1><i class="fa fa-edit"></i> Manage grade</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Home</li>
          <li class="breadcrumb-item"><a href="#">Manage Grade</a></li>
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
                      {{-- <th>Class</th> --}}
                      <th>Grade</th>
                      <th>max</th>
                      <th>min</th>
                      <th>Grade Point</th>
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
              <h3 class="tile-title border-bottom p-2" id="title"> Add Grade Letter</h3>
            <div class="tile-body">
           {{--  <div class="form-group">
                <label for="exampleSelect1">Select Class</label>
                <select class="form-control" id="classId" name="classId">
                @foreach ($class as $class)
                <option value="{{$class->id}}">{{$class->className}}</option>
                @endforeach
                </select>
            </div> --}}
            <div class="form-group">
                <label for="exampleSelect1"> Letter Grade</label>
                {{-- <input class="form-control"  type="text" id="gradeName" name="gradeName" placeholder="Enter Grade Name"> --}}
                <select class="form-control" id="gradeName" name="gradeName">
                    <option value=""> Select Grade </option>
                    <option value="A+">A+</option>
                    <option value="A">A</option>
                    <option value="A-">A-</option>
                    <option value="B+">B+</option>
                    <option value="B">B</option>
                    <option value="B-">B-</option>
                    <option value="C+">C+</option>
                    <option value="C">C</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                    <option value="F">F</option>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleSelect1">Max value</label>
                <input class="form-control"  type="number" id="maxValue" name="maxValue"  max="100" min="0"  onblur="setMaxValue()" placeholder="Enter max value">
            </div>
            <div class="form-group">
                <label for="exampleSelect1">Min value </label>
                    <input class="form-control"  type="number"  max="" min="0" id="minValue" name="minValue" placeholder="Enter min Value">
            </div>
            <div class="form-group">
                <label for="exampleSelect1">Grade Point </label>
                    {{-- <input class="form-control"  type="number"  max="" min="0" id="gradePoint" name="gradePoint" placeholder="Enter gradePoint"> --}}
                    <select class="form-control" id="gradePoint" name="gradePoint">
                        {{--  <option value=""> Select point </option>
                        <option value="5.00">5.00</option>
                        <option value="4.00">4.00</option>
                        <option value="3.50">3.50</option>
                        <option value="3.00">3.00</option>
                        <option value="2.00">2.00</option>
                        <option value="1.00">1.00</option>
                        <option value="0.00">0.00</option>  --}}
                        <option value=""> Select point </option>
                        <option value="5">5.00</option>
                        <option value="4">4.00</option>
                        <option value="3.5">3.50</option>
                        <option value="3">3.00</option>
                        <option value="2">2.00</option>
                        <option value="1">1.00</option>
                        <option value="0">0.00</option>
                    </select>
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
    function setMaxValue(){
        var max = $('#maxValue').val();
        $('#minValue').attr('max', max-9);
    }
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
             ajax:"{{url('/grade/show')}}",
             columns:[
                 { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                 {{-- { data: 'classes.className', name: 'classes.className' }, --}}
                 { data: 'gradeName', name: 'gradeName' },
                 { data: 'maxValue', name: 'maxValue' },
                 { data: 'minValue', name: 'minValue' },
                 { data: 'gradePoint', name: 'gradePoint' },
                 { data: 'action', name: 'action' }
             ]
         });

          //update and submit

          $('#submit').click(function (e) {
                e.preventDefault();

                var id=$('#submit').val();

               {{-- var classId= $('#classId option:selected').val(); --}}
               var gradeName= $('#gradeName option:selected').val();
               var maxValue= $('#maxValue').val();
               var minValue= $('#minValue').val();
               var gradePoint= $('#gradePoint option:selected').val();
             // console.log(gradeName,maxValue,minValue,gradePoint);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                });
                if (id>0) {
                   var url="{{url('grade/update')}}"+"/"+id;
               }else{
                   var url="{{url('/grade/store')}}"
               }
                jQuery.ajax({
                    method: 'post',
                    url: url,
                    data: {

                    gradeName: gradeName,
                    maxValue: maxValue,
                    minValue: minValue,
                    gradePoint: gradePoint,
                    },

                    success: function(result){
                        if (result.success) {
                            $( "div" ).remove( ".text-danger" );
                           // console.log(result);
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
        function editGrade(id) {

            setUpdateProperty(id, "subject");
            var url="{{url('/grade/edit')}}";
            $.ajax({
                type:'GET',
                url:url+"/"+id,
                success:function(data) {

                    {{-- $('#classId').val(data.classId); --}}
                    $('#gradeName').val(data.gradeName);
                    $('#maxValue').val(data.maxValue);
                    $('#minValue').val(data.minValue);
                    //$('#gradePoint').val(data.gradePoint).find(":selected");
                    //$('#gradePoint').val(data.gradePoint).prop('selected', true);
                    //$('#gradePoint').html(data.gradePoint);
                    //$('#gradePoint').html(data.gradePoint).prop('selected', true);
                    $('#gradePoint').val(data.gradePoint);
                    console.log(data);


            }
            });

        }

         //delete
         function deleteGrade(id) {
                var url = "{{url('/grade/delete')}}";
                deleteAttribute(url,id);
        }

</script>
  @endsection
