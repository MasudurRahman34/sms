@extends('backend.layouts.master')
	@section('title', 'Admin|| Fee Distribution')
    @section('content')
    <div class="app-title">
        <div>
          <h1><i class="fa fa-edit"></i>Section Wish Student Fee Collection </h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Home</li>
          <li class="breadcrumb-item"><a href="#">Student Fee Collection</a></li>
        </ul>
    </div>
    @include('backend.partials._message')
    <style>
        @media print{
            .table-bordered{
            background-color: green;
        }
    }
    </style>
<div class="row justify-content-md-center">
    <div class="clearix"></div>
        <div class="col-md-10">
            <div class="tile">
                <div class="tile-body">
                <div class="row">
                    {{--  <div class="form-group col-xs-2 pr-2">
                        <label for="exampleFormControlSelect1">Session Year</label>
                        <select class="form-control admission" id="sessionYear" >
                            <option value="">--Please Select--</option>
                            <option value="{{$sessionYearId}}">{{$sessionYear}}</option>
                            @foreach ($sessionYear as $year)
                                <option value="{{$year->id}}" {{$year->status == 1 ? 'selected': ''}}>{{$year->sessionYear}}</option>
                            @endforeach
                        </select>
                    </div>  --}}
                    {{--  <div class="form-group col-xs-2">
                        <label class="control-label mt-3">Shift</label><br>
                            <div class="custom-control shift-radio custom-control-inline">
                                <input type="radio" name="shift" id="shift1" value="Morning" class="custom-control-input admission" checked>
                                <label class="custom-control-label"  for="shift1">Morning</label>
                            </div>
                            <div class="custom-control shift-radio custom-control-inline">
                                <input type="radio" name="shift" id="shift2" value="Day" class="custom-control-input admission">
                                <label class="custom-control-label" for="shift2">Day</label>
                            </div>
                            <div class="custom-control shift-radio custom-control-inline">
                                <input type="radio" name="shift" id="shift3" value="Evening" class="custom-control-input admission">
                                <label class="custom-control-label" for="shift3">Evening</label>
                            </div>
                    </div>
                     <div class="form-group col-xs-2 pr-2">
                        <label for="exampleFormControlSelect1">Select Class</label>
                        <select class="form-control admission" id="classId" name="classId">
                            <option value="">--Please Select--</option>
                            <option value="{{$classId}}">{{$className}}</option>
                            @foreach ($class as $class)
                            <option value="{{$class->id}}">{{$class->className}}</option>
                            @endforeach
                        </select>
                    </div>  --}}
                    <div class="form-group col-md-4 pr-2" id="hidden" >
                        <label for="exampleFormControlSelect1"> Fee Name</label>
                            <select class="form-control feeChange" id="feeId">

                                    <option value="">--Select Fee--</option>

                            </select>
                    </div>
                    <div class="form-group col-md-4 pr-2" id="hidden1" >
                        <label for="exampleFormControlSelect1"> Amount</label>
                        <input class="form-control feeChange" type="number" id="amount" name="amount" required  readonly>

                    </div>

                    <div class="form-group col-md-4 pr-2" >
                        <label for="exampleFormControlSelect1"> Month</label>
                        {{-- <input class="form-control " id="month" type="month" placeholder="Pick a month" value="{{date('Y-m')}}"/> --}}
                        <select class="form-control feeChange" id="month">
                            <option value="">--Select Fee--</option>
                            <option value="JANUARY">JANUARY</option>
                            <option value="FEBRUARY">FEBRUARY</option>
                            <option value="MARCH">MARCH</option>
                            <option value="APRIL">APRIL</option>
                            <option value="MAY">MAY</option>
                            <option value="JUNE">JUNE</option>
                            <option value="JULY">JULY</option>
                            <option value="AUGUST">AUGUST</option>
                            <option value="SEPTEMBER">SEPTEMBER</option>
                            <option value="OCTOBER">OCTOBER</option>
                            <option value="NOVEMBER">NOVEMBER</option>
                            <option value="DECEMBER">DECEMBER</option>
                    </select>
                    </div>
                    {{--  <div class="form-group col-xs-2">
                        <label for="exampleFormControlSelect1"> Section</label>
                        <select class="form-control feeChange" id="sectionId">
                            <option value=""> --Please Select--  </option>
                            <option value="{{$sectionId}}">{{$sectionName}}</option>
                        </select>
                    </div>  --}}

                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="clearix"></div>

<div class="row justify-content-md-center">
    <div class="col-md-10 ">
        <div class="tile">
            {{-- need to add field for input --}}
                <div class="tile-body" id="tblHidden" hidden>
                    <form action="{{route('myclass.feecollection.store')}}" method="Post"   id="myfeeform">
                        @csrf
                        <input type="text" name="sectionId" id="sectionId2" value="{{$sectionId}}" hidden>
                        <input type="text" name="classId2" id="classId2"  value="{{$classId}}" hidden>
                        <input type="text" name="shift" id="shift"  value="{{$shift}}" hidden>
                        <input type="text" name="feeId2" id="feeId2" hidden>
                        <input type="text" name="amount2" id="amount2" hidden>
                        <input type="text" name="month2" id="month2" hidden>
                        <input type="text" name="sessionYear2" id="sessionYear2" value="{{$sessionYearId}}" hidden>
                        <input type="text" name="paymentType2" id="paymentType2" hidden>
                        <input type='button' class="bg-warning text-dark float-right"  value=' Print ' id='doPrint'>
                            <div class="table-responsive"  id="print_div">
                                <table class="table table-hover table-bordered" id="sampleTable">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" id="allcb" /> Select All</th>
                                            <th>Student Roll</th>
                                            <th>Student Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        <button class="btn btn-primary" type="submit" id="btnFee"  disabled="true"  ><i class="fa fa-plus-square" aria-hidden="true"></i>Take Fee</button>
                    </form>
                </div>
            </div>
    </div>
    <div class="clearix"></div>

  <!-- The Modal -->
  <div class="modal" id="newModal" >
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Fee Collection</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                Fee has been Taken At This Type for This month, Do You Want to Update it!
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" id="unpaid" data-dismiss="modal">Update Un-Paid List</button>
              <button type="button" class="btn btn-primary" id="paid" data-dismiss="modal">Update Paid List</button>
              <button type="button" class="btn btn-danger" id="cancel" data-dismiss="modal">Close</button>
            </div>

      </div>
    </div>
  </div>

@endsection
@section('script')
<script src="{{ asset('admin/js/printThis.js') }} "></script>
    <script>

        function checkedAtlestOne(){
            $("#myfeeform").submit(function () {
                var idChecked= new Array;
                var roll=true;
                $("#myfeeform input[type=checkbox]:checked").each(function(){

                    idChecked.push(this.value);
                });

                if(idChecked.length>0){
                    return roll=true;
                    }else{
                        alert(' Check At least one ');
                        roll= false;
                }return roll;
            });
        }


    $(document).ready(function () {
        //e.preventDefault();
        //var classId= $("#classId2").val();
        var classId= {{$classId}};
        //var sessionYearId=$('#sessionYear2').val();
        var sessionYearId= {{$sessionYearId}};
        //var shift=$('input[name="shift"]:checked').val();
        //var shift=$('shift').val();
        //var shift= {{$shift}};
        console.log(classId);
        //var url='/api/search/sectionbyclass';
        var data= {
            'classId' : classId,
            //'sessionYearId' : sessionYearId,
            //'shift' : shift,
        }
        if(classId>0){
            $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        },
                    });

            $.ajax({
                type: "get",
                url:'/api/search/classfeelist',
                data: data,
                success: function (data) {
                    {{--  console.log(data);  --}}
                    var option="<option>--Please Select--</option>";
                    data.forEach(element => {

                        option+=("<option value='"+element.id+"'>"+element.name+"</option>");
                    });
                    $('#feeId').html(option);
                }
            });
        }
    });


//on change fee id for find amount
    $('.feeChange').change(function (e) {
        e.preventDefault();
        var feeId= $("#feeId").val();
        {{--  console.log(feeId);  --}}
        var url='/api/search/feeamount';
        var data= {
                'feeId' : feeId,
            }
        $.ajax({
            type: "get",
            url:url,
            data: data,
            success: function (data) {
               // console.log(data);
            //var amount = data;
                //$('#amount').text();
                $('#amount').val(data);
            }
        });
    });
    $('#month').change(function (e) {
        //var sectionId=$("#sectionId").val();
        var sectionId= {{$sectionId}};
        $("#sectionId2").attr('value',sectionId);
        var classId=$("#classId").val();
        $("#classId2").attr('value',classId);

        var amount=$("#amount").val();
        $("#amount2").attr('value',amount);
        var feeId=$("#feeId").val();
        $("#feeId2").attr('value',feeId);
        var month=$("#month").val();
        $("#month2").attr('value',month);
        var sessionYear=$("#sessionYear").val();
        var sessionYear= {{$sessionYearId}};
        $("#sessionYear2").attr('value',sessionYear);
        console.log(month,sectionId,feeId,sessionYear);
        // console.log(sectionId2,amount2,feeId2,month2,sessionYear2);

        if(sectionId>0){
            $.ajax({
              type: "post",
              url: "{{ url('/myclass/student/Data')}}",
              data: {
                sectionId:sectionId,
                feeId:feeId,
                month:month,
                sessionYear:sessionYear,
              },
              success: function (response) {
                  if(response.dueStudent){
                      //  console.log('if due student');
                    //Un-Paid Student
                    $("#newModal").modal("show");
                    $("#unpaid").click(function(e){
                        console.log(response.dueStudent.length);
                        if(response.dueStudent.length>0){

                            $('#tblHidden').attr('hidden',false);
                            $('#btnFee').attr('disabled',false);
                                var tr='';
                                    $.each (response.dueStudent, function (key, value) {
                                        tr +=
                                            "<tr>"+
                                                "<td>"+
                                                    '<input class="roll" type="checkbox" name="studentId['+value.id+']" value="'+value.id+'">'
                                                +"</td>"+
                                                "<td>"+value.roll+"</td>"+
                                                "<td>"+value.firstName+' '+value.lastName+"</td>"+
                                            "</tr>";
                                    });
                                $('tbody').html(tr);
                            checkedAtlestOne();

                        }else{
                            $('#tblHidden').attr('hidden',true);
                        }
                    });
                    $("#paid").click(function(e){
                        //for lode paid student list
                        //  console.log('else paid student');
                        $('#tblHidden').attr('hidden',false);
                        $('#btnFee').attr('disabled',false);
                            var tr='';
                                $.each (response.paidStudent, function (key, value) {

                                    $("input[id='fee'][value='"+value.id+"']").prop('checked', true);
                                    tr +=
                                        "<tr>"+
                                            "<td>"+
                                                '<input class="roll" type="checkbox" name="studentId['+value.id+']" value="'+value.id+'"  checked>'
                                            +"</td>"+
                                            "<td>"+value.roll+"</td>"+
                                            "<td>"+value.firstName+' '+value.lastName+"</td>"+
                                        "</tr>";
                                $('#btnFee').html("Update Fee");
                            $('#myfeeform').attr("action", "{{route('myclass.feecollection.update')}}");
                        });
                    $('tbody').html(tr);
                });
                }else{
                    if(response.length>0){
                        // console.log('else new entry');
                        //  console.log(response);
                        //newly add  fee data
                        $('#tblHidden').attr('hidden',false);
                        $('#btnFee').attr('disabled',false);
                            var tr='';
                                $.each (response, function (key, value) {
                                    tr +=
                                        "<tr>"+
                                            "<td>"+
                                                '<input class="roll" type="checkbox" name="studentId['+value.id+']" value="studentId['+value.id+']" >'
                                            +"</td>"+
                                            "<td>"+value.roll+"</td>"+
                                            "<td>"+value.firstName+' '+value.lastName+"</td>"+
                                        "</tr>";
                                });
                            $('tbody').html(tr);
                        checkedAtlestOne();
                        }//End if
                    }
                }
            });
        }

        //select checked box All
        $('#allcb').change(function () {
            $('tbody tr td input[type="checkbox"]').prop('checked', $(this).prop('checked'));
        });

    });

//print button in table
    $('#doPrint').on("click", function () {
        $('#print_div').printThis({
            debug: false,               // show the iframe for debugging
            importCSS: true,            // import parent page css
            importStyle: true,         // import style tags
            printContainer: true,       // print outer container/$.selector
            loadCSS: "",                // path to additional css file - use an array [] for multiple
            pageTitle: "",              // add title to print page
            removeInline: false,        // remove inline styles from print elements
            removeInlineSelector: "*",  // custom selectors to filter inline styles. removeInline must be true
            printDelay: 533,            // variable print delay
            header: null,               // prefix to html
            footer: null,               // postfix to html
            base: false,                // preserve the BASE tag or accept a string for the URL
            formValues: true,           // preserve input/form values
            canvas: false,              // copy canvas content
            doctypeString: '...',       // enter a different doctype for older markup
            removeScripts: false,       // remove script tags from print content
            copyTagClasses: false,      // copy classes from the html & body tag
            beforePrintEvent: null,     // function for printEvent in iframe
            beforePrint: null,          // function called before iframe is filled
            afterPrint: null            // function called before iframe is removed
        });
      });
    </script>
    @endsection

