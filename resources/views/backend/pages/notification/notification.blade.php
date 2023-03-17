@extends('backend.layouts.master')
	@section('title', 'Notification Management')
    @section('content')
    {{-- //main content --}}
    <div class="app-title">
        <div>
          <h1><i class="fa fa-bullhorn"></i> Notifications </h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Home</li>
          <li class="breadcrumb-item"><a href="#">Manage Classes</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
                <form id="myform" action="javascript:void(0)">
            <div class="tile">
                <h3 class="tile-title border-bottom p-2" id="title"><i class="fa fa-bell" aria-hidden="true"></i>Compose The New Notification </h3>
                <div class="box box-primary">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">  
                            <input type="hidden" name="ci_csrf_token" value="">                                
                            <div class="col-md-9">
                              <div class="form-group">
                                <label for="exampleInputEmail1">Title</label><small style="color:red"> *</small>
                                <input autofocus="" id="title" name="title" placeholder="" type="text" class="form-control" value="" autocomplete="off">
                                <span class="text-danger"></span>
                              </div>
                                <div class="form-group"><label>Message</label><small style="color:red"> *</small>
                                    {{-- CKEDITOR --}}
                                    <div>
                                    <textarea name="answer" id="answer" rows="14" cols="190"
                                        data-parsley-minlength="6"
                                        data-parsley-minlength-message="Come on! You need to enter at least a 6 character comment..">
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Notice Date</label><small style="color:red"> *</small>
                                        <input type="text" class="form-control" id="demoDate" placeholder="Select Date">
                                        <span class="text-danger"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Publish On</label><small style="color:red"> *</small>
                                        <input id="publish_date" name="publish_date" placeholder="" type="text" class="form-control date" value="">
                                        <span class="text-danger"></span>
                                    </div>
                                    <div class="form-horizontal">
                                        <label for="exampleInputEmail1">Message To</label><br>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <label><input type="checkbox" name="visible[]" value="student"> <b>Student</b> </label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <label><input type="checkbox" name="visible[]" value="parent"> <b>Parent</b></label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <label><input type="checkbox" name="visible[]" value="1"> <b>Admin</b> </label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <label><input type="checkbox" name="visible[]" value="2" checked=""> <b>Teacher</b> </label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <label><input type="checkbox" name="visible[]" value="3"> <b>Accountant</b> </label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <label><input type="checkbox" name="visible[]" value="4"> <b>Librarian</b> </label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <label><input type="checkbox" name="visible[]" value="6"> <b>Receptionist</b> </label>
                                        </div>
                                    </div>
                                    <span class="text-danger"></span>
                                </div>
                            </div>  
                        </div>                                                   
                    </div>                      
                </div>
                <div class="tile-footer">
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-primary edit_studClass"  style="float: right;" id="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Send</button>
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
    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
      {{-- @include('backend.partials.js.datatable'); --}}
      <script>
        CKEDITOR.replace( 'answer' );
        $('#demoDate').datepicker({
      	format: "dd/mm/yyyy",
      	autoclose: true,
      	todayHighlight: true
      });
      $('#publish_date').datepicker({
      	format: "dd/mm/yyyy",
      	autoclose: true,
      	todayHighlight: true
      });
      </script>
      <script type="text/javascript">
        if(document.location.hostname == 'pratikborsadiya.in') {
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
            ga('create', 'UA-72504830-1', 'auto');
            ga('send', 'pageview');
        }
      </script>
    @endsection

