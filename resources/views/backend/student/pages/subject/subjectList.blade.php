@extends('backend.student.layouts.master')
	@section('title', 'Student Subject Page')
    @section('content')
    <div class="app-title">
        <div class="hmmm">
          <h1><i class="fa fa-edit"></i> Manage Section</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Home</li>
          <li class="breadcrumb-item"><a href="#">Manage Section</a></li>
        </ul>
    </div>
    <div class="row justify-content-md-center">
    <div class="col-md-7">
        <div class="tile">
            <div class="tile-body">
                <div class="table-responsive">
                <table class="table table-hover table-bordered" id="sampleTable">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Subject Name</th>
                            <th>Subject Code</th>
                            <th>Subject Type</th>
                            <th>PDF DownLoad</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($subjectlists as $subject)
                    <tr>
                    <td></td>
                    <td>{{$subject->subjectName}}</td>

                    <td>{{$subject->subjectCode}}</td>
                    <td>{{$subject->group}}</td>

                    <td>
                    <button class="btn btn-primary"><i class="fa fa-edit" onclick="subject() "></i></button>
                    </td>
                  </tr>
                  @endforeach

                  {{-- for optional subject --}}
                  @foreach($Student->studentoptionalsubjects as $optionalSubject)
                    <tr>
                    <td>#</td>
                    <td>{{$optionalSubject->Subject->subjectName}} <span class="text-danger">{{$optionalSubject->optional==0 ? "(optinal)": ""}}</span></td>
                    <td>{{$optionalSubject->Subject->subjectCode}}</td>
                    <td>{{$optionalSubject->Subject->group}}</td>
                    <td>
                    <button class="btn btn-primary"><i class="fa fa-edit" onclick="subject() "></i></button>
                    </td>
                  </tr>
                  @endforeach



                </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="clearix"></div>
    @endsection
    @section('script')
       <!-- @include('backend.student.partials.js.datatable');  -->

    <!-- <script src="{{ asset('admin/js/plugins/chart.js') }} "></script> -->
    <script type="text/javascript">

function subject(){
    alert('File is not Included');
}
  </script>

@endsection
