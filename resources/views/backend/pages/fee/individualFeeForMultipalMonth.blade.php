@extends('backend.layouts.master')
	@section('title', 'Admin|| Individual Fee Collection')
    @section('content')
    <div class="app-title">
        <div>
          <h1><i class="fa fa-edit"></i>Section Wish Student Individual Fee Collection </h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Home</li>
          <li class="breadcrumb-item"><a href="#">Individual Students Fee Collection</a></li>
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
        <div class="col-md-8">
            <div class="tile">
                <div class="tile-body">
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="exampleFormControlSelect1">Session Year</label>
                        <select class="form-control " id="sessionYear" >
                            <option value="">--Please Select--</option>
                            @foreach ($sessionYear as $year)
                                <option value="{{$year->id}}" {{$year->status == 1 ? 'selected': ''}}>{{$year->sessionYear}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">
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

                     <div class="form-group col-md-4">
                        <label for="exampleFormControlSelect1">Select Class</label>
                        <select class="form-control admission" id="classId" name="classId">
                            <option value="">--Please Select--</option>
                            @foreach ($class as $class)
                            <option value="{{$class->id}}">{{$class->className}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="exampleFormControlSelect1"> Section</label>
                        <select class="form-control" id="sectionId">
                            <option value=""> --Please Select--  </option>
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="exampleFormControlSelect1"> Student Name</label>
                        <select class="form-control studentIdAndfeeId" id="studentId" required>
                            <option value=""> --Please Select--  </option>
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="exampleFormControlSelect1"> Fee Name</label>
                        <select class="form-control studentIdAndfeeId" id="feeId">
                                <option value="">--Select Fee--</option>
                        </select>
                    </div>


                    <div class="form-group col-md-4 pr-2" id="btnamount" hidden>
                        <label for="exampleFormControlSelect1"> Amount</label>
                        <input class="form-control " type="number" id="amount1" name="amount1" required  readonly>

                    </div>
                    <div class="form-group col-md-4" id="btndiscount" hidden>
                        <label for="exampleFormControlSelect1">Discount  (<em id="percentage" style="color:red"></em> %)</label>
                        <input class="form-control" type="number" id="discount" name="discount" value="" readonly>
                    </div>
                    <div class="form-group col-md-4" id="stamount" hidden>
                        <label for="exampleFormControlSelect1"> Total charge</label>
                        <input class="form-control " type="number" id="totalCharge" name="amount" value="" readonly hidden>

                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
<div class="clearix"></div>

<div class="row justify-content-md-center">
    <div class="col-md-8 ">
        <div class="tile">
            {{-- need to add field for input --}}
                <div class="tile-body" id="tblHidden" hidden>
                    <form action="{{route('store.storeMorethenOneMonth')}}" method="post" id="myform" name="form" >
                        @csrf
                       <input type="text" name="sectionId" id="sectionId2" hidden >
                       <input type="text" name="classId2" id="classId2" hidden>
                       <input type="text" name="feeId2" id="feeId2" hidden>
                       <input type="text" name="amount2" id="amount2" hidden>
                       {{--  <input type="text" name="month2" id="month2" hidden >  --}}
                       <input type="text" name="sessionYear2" id="sessionYear2" hidden>
                       <input type="text" name="paymentType2" id="paymentType2" hidden>
                       <input type="text" name="studentId2" id="studentId2" hidden >
                       <input type="text" name="totalCharge2" id="totalCharge2" hidden>
                       <input type='button'  value='Print' id='doPrint'>
                        <div class="table-responsive"  id="print_div">
                            <table class="table table-hover table-bordered" id="sampleTable">
                                <thead>
                                <tr>
                                    <th><input type="checkbox" id="allcb" /> Select All</th>
                                    <th>Month</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            {{-- <table class="table table-hover table-bordered" id="sampleTable">
                                <thead>
                                    <tr>
                                        <th>Fee Name</th>
                                        <th>Type</th>
                                        <th>Amount</th>
                                        <th>Due</th>
                                        <th>Total Paid</th>
                                        <th>Taken Date</th>
                                    </tr>
                                </thead>
                                <tbody id="fee">
                                </tbody>
                            </table> --}}
                        </div>
                        <button class="btn btn-primary" type="submit" id="btnFee"  disabled="true"><i class="fa fa-plus-square" aria-hidden="true"></i>Take Fee</button>
                    </form>
                </div>
            </div>
    </div>
    <div class="clearix"></div>
    @endsection
    @section('script')
    {{-- <script src="{{ asset('admin/js/printThis.js') }} "></script> --}}
    <script>

        function checkedAtlestOne(){
            $("#myform").submit(function () {
                var idChecked= new Array;
                var roll=true;
                $("#myform input[type=checkbox]:checked").each(function(){
                    idChecked.push(this.value);
                });
                if(idChecked.length>0){
                    return roll=true;
                }else{
                    roll= false;
                    alert('missing');

                }return roll;

              });
        }

    $('.admission').change(function (e) {
        e.preventDefault();

        $('#tblHidden').attr('hidden',true);
        $('#btnFee').attr('disabled',true);
        var classId= $("#classId").val();
        var sessionYearId=$('#sessionYear').val();
        var shift=$('input[name="shift"]:checked').val();
        console.log(classId);
        var url='/api/search/sectionbyclass';
        var data= {
            'classId' : classId,
            'sessionYearId' : sessionYearId,
            'shift' : shift,
        }
        if(classId>0){
            $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        },
                    });
            $.ajax({
                type: "post",
                url:url,
                data: data,
                success: function (data) {
                    var option="<option>--Please Select--</option>";
                    data.forEach(element => {
                        option+=("<option value='"+element.id+"'>"+element.sectionName+"</option>");
                    });
                    $('#sectionId').html(option);
                }
            });
            $.ajax({
                type: "get",
                url:'/api/search/classfeelist',
                data: data,
                success: function (data) {
                    var option="<option>--Please Select--</option>";
                    data.forEach(element => {
                        option+=("<option value='"+element.id+"' data-amount='"+element.amount+"' data-type='"+element.interval+"'>"+element.name+"</option>");
                    });
                    $('#feeId').html(option);
                }
            });
        }
    });

 //Get fee amount in change of fee name
    $('#sectionId').change(function (e) {
    e.preventDefault();

    sectionId=$(this).val();
    console.log(sectionId);
            $.ajax({
                type: "POST",
                url: "{{ url('feecollection/individualStudent')}}",
                data: {
                sectionId:sectionId,
                //feeId:feeId,
                // month:month,
                },
                success: function (data) {
                //change start from here
                var option="<option>--Please Select--</option>";
                data.forEach(element => {
                    option+=("<option value='"+element.id+"'>"+element.firstName+' '+element.lastName+'('+element.roll+')'+"</option>");
                    });
                    $('#studentId').html(option);
                    }
                });
    });//end sectionId

    //on change section for find student
    //$("#sectionId").change(function(){
    $(".studentIdAndfeeId").change(function(){
        //change in section to .change 21/1/20
        var feeAmount= $("#feeId option:selected").data('amount');
        $("#amount1").attr('value',feeAmount);

        var type= $("#feeId option:selected").data('type');

        var feeId= $("#feeId option:selected").val();

        var studentId= $("#studentId option:selected").val();
        console.log(feeAmount,feeId,studentId);

        //on change section for find student

        //$('#studentId').change(function (e) {
          //  e.preventDefault();
        var sectionId=$("#sectionId").val();
        $("#sectionId2").attr('value',sectionId);
        var classId=$("#classId").val();
        $("#classId2").attr('value',classId);

        var amount=$("#amount1").val();
        $("#amount2").attr('value',amount);

        var feeId=$("#feeId").val();
        $("#feeId2").attr('value',feeId);
        //var month=$("#month").val();
       // $("#month2").attr('value',month);
        var sessionYear=$("#sessionYear").val();
        $("#sessionYear2").attr('value',sessionYear);
        var studentId=$("#studentId").val();
        var st= $("#studentId2").attr('value',studentId);

        //var discount=$("#discount").val();
        //$("#discount2").attr('value', discount);

        // console.log(discount2);
        // console.log('seesetproparty');
        console.log(sectionId2,amount2,feeId2,sessionYear2,studentId2);
        // scholarship amount check for due calculation
        if(studentId>0 && feeId>0){
            $.ajax({
                type: "POST",
                //url: "{{ url('feecollection/individualStudentfind')}}",
                url: "{{ url('/feecollection/individual/findmonthlyyearlyfee')}}",
                data: {

                    feeId:feeId,
                    studentId:studentId,
                    amount:feeAmount,
                    type:type,
                    sessionYear:sessionYear,
                },
                success: function (data) {

                    console.log(data);
                    console.log(data.discountAmount);
                    console.log(data.percentage);
                    console.log(data.paidAmount);

                    $('#btnamount').attr('hidden',false);
                    $('#stamount').attr('hidden',false);
                    $('#totalCharge').attr('hidden',false);
                    $('#totalCharge').attr('value', data.paidAmount);
                    $('#btndiscount').attr('hidden',false);
                    $('#discount').attr('value', data.discountAmount);
                    $('#percentage').html(data.percentage);


                    var totalCharge=$("#totalCharge").val();
                    $("#totalCharge2").attr('value', totalCharge);

                        console.log("else");
                        //$('#tblHidden').attr('hidden',false);
                        //$('#btnFee').attr('disabled',false);
                        $('#btnFee').html("Take Fee");


                        //for yearly feetype
                        if(data.yearlypayment){
                            console.log("yearly");

                            $('#tblHidden').attr('hidden',false);
                            $('#btnFee').attr('disabled',false);
                            $('tbody').html(data.yearlypayment);
                            checkedAtlestOne();

                            if(data.yearlypayment=="already taken"){
                                console.log("already");
                                alert('Fee is taken for This Session');
                                $('#tblHidden').attr('hidden',true);
                                $('#btnFee').attr('disabled',true);
                            }

                        }else{
                            //for morethen one month
                            if(data.month.length!=0){

                                $('#tblHidden').attr('hidden',false);
                                $('#btnFee').attr('disabled',false);
                                var tr='';
                                $.each (data.month, function (key, value) {
                                tr +=
                                    "<tr>"+
                                        "<td>"+
                                            '<input class="roll" type="checkbox" name="month['+value.month+']" value="month['+value.month+']">'
                                        +"</td>"+
                                        "<td>"+value.month+"</td>"+
                                "</tr>";
                                });

                                $('tbody').html(tr);
                                checkedAtlestOne();

                                }
                                else{
                                alert('fee is taken');
                                    if(confirm){
                                        window.location.assign("/feecollection/individual/monthly")
                                    }
                                }
                        }
                }
             });

    //});//end studentId
    } //end
});//end change

     //select checked box All
     $('#allcb').change(function () {
     $('tbody tr td input[type="checkbox"]').prop('checked', $(this).prop('checked'));
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


