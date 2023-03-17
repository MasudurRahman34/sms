@extends('backend.layouts.master')
	@section('title', 'Home Page')
    @section('content')
    {{-- //main content --}}
    <div class="app-title">
        <div>
          <h1><i class="fa fa-edit"></i> School Branch</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Home</li>
          <li class="breadcrumb-item"><a href="#">School Branch</a></li>
        </ul>
    </div>
      <div class="row">
      <div class="col-md-8 col-sm-12">
        <div class="tile">
          <h3 class="tile-title border-bottom p-2">Add New School Branch</h3>
          <div class="tile-body">
                <form class="" method="POST" action="{{ route('addSchoolBranch.store') }}">
                        @csrf
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
                            <label class="control-label">Email</label>
                            <input class="form-control" type="text" id="email" name="email" placeholder="Email" autofocus>
                        </div>
                       <div class="form-group">
                        <label class="control-label">District</label>
                        <select class="form-control" id="district" name="district">
                          <option value="Faridpur">Faridpur</option>
                          <option value="Jeshore">Jeshore</option>
                          <option value="Dhaka">Dhaka</option>
                          <option value="Feni">Feni</option>
                          <option value="Comilla">Comilla</option>
                        </select>
                      </div>
                      <div class="form-group">
                          <label for="exampleSelect1">Upozila</label>
                          <select class="form-control" id="upazilla" name="upazilla">
                            <option value="Boalmari Upazila">Boalmari Upazila</option>
                            <option value="MohammadPur">MohammadPur</option>
                            <option value="Dhanmodi">Dhanmodi</option>
                            <option value="5">Bhanga Upazila</option>
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
                            <input class="form-check-input" id="schoolType" type="radio" name="schoolType" value="Public School" checked="">Public Schools
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
          <div class="tile-footer">
                <div class="row">
                  <div class="col-md-12 col-sm-12">
                    <button class="btn btn-primary" type="submit" style="float: right;"><i class="fa fa-fw fa-lg fa-check-circle"></i>Submit</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="#"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                  </div>
                </div>
            </div>
          </div>
        </div>
      <div class="clearix"></div>
    @endsection
    @section('script')
      @include('backend.partials.js.datatable');
      <script>

      </script>

    @endsection
