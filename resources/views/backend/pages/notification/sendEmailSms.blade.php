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
            <div class="tile">
                <h3 class="tile-title border-bottom p-2" id="title"><i class="fa fa-bell" aria-hidden="true"></i>Compose The New Notification </h3>
                <div class="box box-primary">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- Custom Tabs (Pulled to the right) -->
                                <div class="nav-tabs-custom">
                                            <form action="{{ route('notification.create') }}" method="post" id="group_form">
                                                @csrf
                                                <!-- /.box-header -->
                                                <div class="box-body">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <div class="form-group">
                                                                <label>Title</label><small class="req"> *</small>
                                                                <input autofocus="" class="form-control" name="title" autocomplete="off" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="pr20">Send Through<small class="req"> *</small></label>
                                                                <label class="checkbox-inline">
                                                                    <input type="checkbox" value="mail" name="sendBy[]"> Email
                                                                </label>
                                                                <label class="checkbox-inline">
                                                                    <input type="checkbox" value="sms" id="sms" name="sendBy[]">SMS
                                                                </label>
                                                                <label class="checkbox-inline">
                                                                    <input type="checkbox" value="system" name="sendBy[]">System
                                                                </label>
                                                                <span class="text-danger"></span>
                                                            </div>
                                                            <div class="form-group"><label>Message<small style="color:red"> *</small> <span id="word"></span> <span id="charechter"></span></label>
                                                                {{-- CKEDITOR --}}

                                                                <textarea class="form-control" name="msg" id="msg" rows="14" cols="15" required style="height: auto;"></textarea>
                                                            </div>
                                                            </div>
                                                            {{-- Group er Box --}}
                                                            <div class="col-md-4">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <ul class="nav nav-tabs" role="tablist">
                                                                            <li class="nav-item"><a class="nav-link active" href="#tab_group" data-toggle="tab" aria-expanded="true">Group</a></li>
                                                                            {{-- <li class="nav-item"><a class="nav-link" href="#tab_class" data-toggle="tab" aria-expanded="false">Class</a></li>&nbsp;<br>
                                                                            <li class="nav-item"><a class="nav-link" href="#tab_perticular" data-toggle="tab" aria-expanded="false">Individual</a></li>&nbsp; --}}
                                                                        </ul> <br><br>
                                                                    </div>
                                                                <div class="col-md-12">
                                                                <div class="tab-content">
                                                                    <div class="tab-pane fade show active" id="tab_group">
                                                                      <div class="bs-component">
                                                                        <div class="jumbotron">
                                                                                <div class="well minheight400">
                                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                                        <label><input type="checkbox" name="contactType[]" value="student"> <b>Student</b> </label>
                                                                                    </div>
                                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                                        <label><input type="checkbox" name="contactType[]" value="employee"> <b>Employee</b></label>
                                                                                    </div>
                                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                                        <label><input type="checkbox" name="contactType[]" value="teacher"> <b>teacher</b></label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="tab-pane" id="tab_perticular">
                                                                        <div class="bs-component">
                                                                          <div class="jumbotron">
                                                                            <div class="form-group">
                                                                                <label for="inpuFname">Message To</label><small class="req"> *</small>
                                                                                <div class="input-group">
                                                                                    <div class="input-group-btn bs-dropdown-to-select-group">
                                                                                        <button type="button" class="btn btn-default btn-searchsm dropdown-toggle as-is bs-dropdown-to-select" data-toggle="dropdown">
                                                                                            <span data-bind="bs-drp-sel-label">Select</span>
                                                                                            <input type="hidden" name="selected_value" data-bind="bs-drp-sel-value" value="">
                                                                                            <span class="caret"></span>
                                                                                        </button>
                                                                                        <ul class="dropdown-menu" role="menu" style="">

                                                                                            <li data-value="student"><a href="#">Students</a></li>
                                                                                            <li data-value="parent"><a href="#">Guardians</a></li>
                                                                                            <li data-value="staff"><a href="#">Admin</a></li>
                                                                                            <li data-value="staff"><a href="#">Teacher</a></li>
                                                                                            <li data-value="staff"><a href="#">Accountant</a></li>
                                                                                            <li data-value="staff"><a href="#">Librarian</a></li>
                                                                                            <li data-value="staff"><a href="#">Receptionist</a></li>
                                                                                        </ul>
                                                                                    </div>
                                                                                    <input type="text" value="" data-record="" data-email="" data-mobileno="" class="form-control" autocomplete="off" name="text" id="search-query">
                                                                                    <div id="suggesstion-box"></div>
                                                                                    <span class="input-group-btn">
                                                                                        <button class="btn btn-primary btn-searchsm add-btn" type="button">Add</button>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="dual-list list-right">
                                                                                <div class="well minheight260">
                                                                                    <div class="row">
                                                                                        <div class="col-md-12">
                                                                                            <div class="input-group">
                                                                                                <input type="text" name="SearchDualList" class="form-control" placeholder="Search...">
                                                                                                <div class="input-group-btn"><span class="btn btn-default input-group-addon bright"><i class="fa fa-search"></i></span></div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="wellscroll">
                                                                                        <ul class="list-group send_list">
                                                                                        </ul>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                              </div>
                                                                          </div>
                                                                      </div>
                                                                      <div class="tab-pane" id="tab_class">
                                                                        <div class="bs-component">
                                                                          <div class="jumbotron">
                                                                            <div class="row">
                                                                                <div class="form-group col-xs-10 col-sm-12 col-md-12 col-lg-12">
                                                                                    <label for="exampleInputEmail1">Message To</label><small class="req"> *</small>
                                                                                    <select id="class_id" name="class_id" class="form-control">
                                                                                        <option value="">Select</option>
                                                                                        <option value="2">Nine</option>
                                                                                            <option value="4">Eight</option>
                                                                                            <option value="5">Seven</option>
                                                                                            <option value="6">Six</option>
                                                                                            <option value="7">Five</option>
                                                                                            <option value="8">Four</option>
                                                                                            <option value="9">Three</option>
                                                                                            <option value="10">Two</option>
                                                                                            <option value="11">One</option>
                                                                                            <option value="12">Ten</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="dual-list list-right">
                                                                                <div class="well minheight260">
                                                                                    <div class="wellscroll">
                                                                                        <b>Section</b>
                                                                                        <ul class="list-group section_list listcheckbox">
                                                                                            <li><input type="checkbox" name="contactType[Class1]" value="1"> A</li>
                                                                                            <li><input type="checkbox" name="contactType[Class2]" value="2">B</li>
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
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tile-footer">
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-primary edit_studClass" type="submit"  style="float: right;" id="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Send</button>
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
          $(document).ready(function () {
            $('#sms').click(function () {
                if($(this).is(":checked")){
                wordCount();
                $('#msg').attr('maxlength', '160');
            }else{
                $('#msg').attr('maxlength', '');
            }
            });

              function wordCount(){
                $('#msg').keyup(function () {
                    var charecter=$(this).val().length;
                    $('#word').html('Max 160 Charecter :' + charecter);
                 });
              }

          });

        // CKEDITOR.replace( 'msg',{
        //     uiColor: '#CCEAEE',
        //    // showWordCount: true,
        // //CKEDITOR.replace( 'classEr' );
        // //CKEDITOR.replace( 'individual' );
        // });

      </script>
    @endsection

