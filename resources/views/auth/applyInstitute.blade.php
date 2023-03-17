<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{{ csrf_token() }}">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="admin/css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>qlt ERP</title>
  </head>
  <body>
    <section class="material-half-bg">
      <div class="cover"></div>
    </section>
    <section class="login-content">
        <div class="logo" style="margin-bottom: 10px;">
          <h1>School Management</h1>
          <!-- <i style="float:left;margin-left:100px;" class="fa fa-graduation-cap fa-3x m-auto" aria-hidden="true"></i> -->
          {{-- <div class="" style="float: left; margin-left: 100px;"><img  class="rounded-circle mx-auto" src="images/hmm.png" alt="img"></div> --}}

        </div>
        <div class="login-box" style="min-width: 430px;
      min-height: 1100px;">
          <form class="login-form" style="top: -28px">

            <h3 class="login-head"><i class="fa fa-graduation-cap" aria-hidden="true"></i>Apply For Service</h3>
            <div class="form-group">
              <label class="control-label">Name Of The Institute</label>
              <input class="form-control" type="text" id="nameOfTheInstitution" name="nameOfTheInstitution" placeholder="Name Of The Institute" autofocus>
            </div>
            <div class="form-group">
              <label class="control-label">EIIN Number</label>
              <input class="form-control" type="text" id="eiinNumber" name="eiinNumber" placeholder="EIIN Number" autofocus>
            </div>
            <div class="form-group">
              <label class="control-label">Phone No</label>
              <input class="form-control" type="text" id="phoneNumber" name="phoneNumber" placeholder="Phone No" autofocus>
            </div>
             <div class="form-group">
              <label class="control-label">District</label>
              <select class="form-control" id="district" name="district">
                <option value> --please Select--</option>
                @foreach ($district as $ds)
                    <option value="{{$ds->id}}" data-districtName="{{$ds->name}}">{{$ds->name}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
                <label for="exampleSelect1">Upozila</label>
                <select class="form-control" id="upazilla" name="upazilla">
                </select>
              </div>
            <div class="form-group">
              <label class="control-label">Address</label>
              <input class="form-control" type="text" id="address" name="address" placeholder="Address" autofocus>
            </div>

            <div class="form-group">
              <label class="control-label">Name Of The Principal</label>
              <input class="form-control" type="text" id="nameOfHead" name="nameOfHead" placeholder="Name Of The Principal" autofocus>
            </div>

            <fieldset class="form-group">
            <label class="control-label" for="">School Type</label>
              <div class="form-check">
                <label class="form-check-label">
                  <input class="form-check-input" id="schoolType" type="radio" name="schoolType" value="Public Schools" checked="">Public Schools
                </label>
                &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                <label class="form-check-label">
                  <input class="form-check-input" id="schoolType" type="radio" name="schoolType" value="Private School">Private School
                </label>
                &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
              </div>
            </fieldset>

            <div class="form-group btn-container">
              <button class="btn btn-primary btn-block" id="ajaxSubmit" type="submit"><i class="fa fa-sign-in fa-lg fa-fw"></i>Sent Request</button>
            </div>
            <br>
          </form>
        </div>
      </section>
    <!-- Essential javascripts for application to work-->
    <script src="admin/js/jquery-3.2.1.min.js"></script>
    <script src="admin/js/popper.min.js"></script>
    <script src="admin/js/bootstrap.min.js"></script>
    <script src="admin/js/main.js"></script>
    <!-- The javaadmin/script plugin to display page loading on top-->
    <script src="admin/js/plugins/pace.min.js"></script>
    <script type="text/javascript" src="admin/js/plugins/sweetalert.min.js"></script>
    <script type="text/javascript">
      // Login Page Flipbox control
      $('.login-content [data-toggle="flip"]').click(function() {
      	$('.login-box').toggleClass('flipped');
      	return false;
      });
    </script>
     <script src="http://code.jquery.com/jquery-3.3.1.min.js"
     integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
     crossorigin="anonymous">
</script>
<script>
jQuery(document).ready(function(){
    getUpazilaByDistrict();

  jQuery('#ajaxSubmit').click(function(e){
     e.preventDefault();
     $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
     jQuery.ajax({
        url: "{{ url('/applyInstitute/store') }}",
        method: 'post',
        data: {
            nameOfTheInstitution: jQuery('#nameOfTheInstitution').val(),
            eiinNumber: jQuery('#eiinNumber').val(),
            phoneNumber: jQuery('#phoneNumber').val(),
            upazilla: jQuery('#upazilla').val(),
            district: jQuery('#district option:selected').attr('data-districtName'),
            nameOfHead: jQuery('#nameOfHead').val(),
            schoolType: jQuery('#schoolType').val(),
            address: jQuery('#address').val(),
        },
        success: function(result){
            swal({
      		title: result.message,
      		text: "Thank For Your Request, We Will Contact With You Soon",
      		type: "success"
      	});
           console.log(result);
        }});
     });
  });

  function getUpazilaByDistrict(){
    $('#district').change(function (e) {
        e.preventDefault();
        var districtId= $(this).val();
        var url="{{route('getUpazilaByDistrict')}}";
        var data= {
            'districtId' : districtId,
        }
        console.log(data);

            $.ajax({
                type: "get",
                url:url,
                data: data,
                success: function (data) {
                    console.log(data);
                    var option="<option>--Please Select--</option>";
                    data.forEach(element => {

                        option+=("<option value='"+element.name+"'>"+element.name+"</option>");

                    });
                    $('#upazilla').html(option);
                }
            });
    });
 }
</script>
  </body>
</html>
