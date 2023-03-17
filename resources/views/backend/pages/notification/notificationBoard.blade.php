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
                <h3 class="tile-title border-bottom p-2" id="title"><i class="fa fa-bell" aria-hidden="true"></i>The Notification Board </h3>
                <div class="box box-primary">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">  
                            <input type="hidden" name="ci_csrf_token" value="">                                
                            <div class="col-md-12">
                                <section class="content">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="box box-solid1 box box-primary">
                                                <div class="box-header with-border">
                                                    <div class="box-tools pull-right">
                                                        <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Post New Message</a>
                                                    </div>
                                                </div>                 
                                                <div class="box-body">
                                                    <div class="box-group" id="accordion">                          
                                                        <div class="panel box box-primary">
                                                            <div class="box-header with-border">
                                                                <h4 class="box-title">
                                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse1" aria-expanded="false" class="collapsed">Absent</a>
                                                                </h4>
                                                                <div class="pull-right">
                                                                    <a href="#" class="" data-toggle="tooltip" title="" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                                                        &nbsp;<a href="#" class="" data-toggle="tooltip" title="" data-original-title="Delete"> <i class="fa fa-remove"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div id="collapse1" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                                <div class="box-body">
                                                                    <div class="row">
                                                                        <div class="col-md-9">
                                                                            <p>Here, i don't do that. Because i know<br></p>                                                    
                                                                        </div><!-- /.col -->
                                                                        <div class="col-md-3">
                                                                            <div class="box box-solid">
                                                                                <div class="box-body no-padding">
                                                                                    <ul class="nav nav-pills nav-stacked">
                                                                                        <li><i class="fa fa-calendar-check-o"></i> Publish Date : 02/18/2020 </li>
                                                                                        <li><i class="fa fa-calendar"></i> Notice Date : 02/18/2020 </li>
                                                                                        <li><i class="fa fa-user"></i> Created By : 
                                                                                            <span data-toggle="popover" class="detail_popover" data-original-title="" title=""><a href="#" style="display: contents;">Teacher</a>
                                                                                            </span>
                                                                                            <div class="fee_detail_popover" style="display: none">Shamin Chowdhury
                                                                                            </div> 
                                                                                        </li>
                                                                                    </ul>
                                                                                    <h4 class="text text-primary"> Message To</h4>
                                                                                    <ul class="nav nav-pills nav-stacked"> 
                                                                                        <li>
                                                                                            <i class="fa fa-user" aria-hidden="true"></i> Teacher                                                                        
                                                                                        </li>
                                                                                        <li><i class="fa fa-user" aria-hidden="true"></i> Student
                                                                                        </li>     
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>                   
                                            </div>
                                        </div>           
                                    </div>
                            </section>
                            </div>
                        </div>                                                   
                    </div>                      
                </div>
                {{-- submit button --}}
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
        
      </script>
    @endsection

