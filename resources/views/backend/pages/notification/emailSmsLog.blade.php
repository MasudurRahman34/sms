@extends('backend.layouts.master')
	@section('title', 'Notification Management')
    @section('content')
    {{-- //main content --}}
    <div class="app-title">
        <div>
          <h1><i class="fa fa-bullhorn"></i> Communicate </h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Home</li>
          <li class="breadcrumb-item"><a href="#">Manage Notification</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title border-bottom p-2" id="title"><i class="fa fa-bell" aria-hidden="true"></i>Compose The New Notification </h3>
                <section class="content ">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <div class="box-tools pull-right">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="tooltip" title="" data-original-title="Add">
                                            <i class="fa fa-envelope-o"></i> Send Email / SMS                            
                                        </a>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <div class="table-responsive mailbox-messages">
                                        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
                                            <div id="DataTables_Table_0_filter" class="dataTables_filter"><label><input type="search" class="" placeholder="Search..." aria-controls="DataTables_Table_0">
                                                </label>
                                            </div>
                                            <table class="table table-striped table-bordered table-hover example dataTable no-footer dtr-inline collapsed" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info" style="width: 1885px;">
                                                <thead>
                                                    <tr role="">
                                                        <th class="col" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 241px;" aria-label="Title: activate to sort column ascending">Title</th>
                                                        <th class="col" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 241px;" aria-label="Date: activate to sort column ascending">Date</th>
                                                        <th class="col" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 265px;" aria-label="Email: activate to sort column ascending">Email</th>
                                                        <th class="col" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 232px;" aria-label="SMS: activate to sort column ascending">SMS</th>
                                                        <th class="col" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 281px;" aria-label="Group: activate to sort column ascending">Group</th>
                                                        <th class="col" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 363px; display: none;" aria-label="Individual: activate to sort column ascending">Individual</th>
                                                        <th class="col" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 167px; display: none;" aria-label="Class: activate to sort column ascending">Class</th>
                                                    </tr>
                                                </thead>
                                                    <tbody>
                                                        
                                                    <tr class="odd"><td valign="top" colspan="5" class="dataTables_empty">No data available in table <br> <br><img src="#" width="150"><br><br> <span class="text-success bolds"><i class="fa fa-arrow-left"></i> Add new record or search with different criteria.</span></td></tr>
                                                </tbody>
                                            </table>
                                            <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">Records: 0 to 0 of 0</div>
                                            <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
                                                <a class="paginate_button previous disabled" aria-controls="DataTables_Table_0" data-dt-idx="0" tabindex="0" id="DataTables_Table_0_previous"><i class="fa fa-angle-left"></i></a>
                                                <span></span>
                                                <a class="paginate_button next disabled" aria-controls="DataTables_Table_0" data-dt-idx="1" tabindex="0" id="DataTables_Table_0_next"><i class="fa fa-angle-right"></i>
                                                </a>
                                            </div></div><!-- /.table -->
            
                                    </div><!-- /.mail-box-messages -->
                                </div><!-- /.box-body -->
                            </div>
                        </div>         
                        <div class="col-md-8">
            
                        </div>          
                    </div>
                    <div class="row">           
                        <div class="col-md-12">
                        </div>
                    </div> 
                </section>
               
            </div>
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

