@extends('backend.layouts.master')
	@section('title', 'Student List Page')
    @section('content')
    <div class="app-title">
        <div>
          <h1><i class="fa fa-edit"></i>Manage All Student</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Home</li>
          <li class="breadcrumb-item"><a href="#">All Student</a></li>
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
      @include('backend.partials.js.datatable');
<script type="text/javascript">

function subject(){
    alert('File is not Included');
}
</script>

@endsection
