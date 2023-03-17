@extends('backend.layouts.master')
@section('title', 'Attendence Details Page')
@section('content')
    {{-- //main content --}}
    <div class="app-title">
        <div>
            <h1><i class="fa fa-plus-square" aria-hidden="true">&nbsp;</i>Student Attendence Details</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">Tables</li>
            <li class="breadcrumb-item active"><a href="#">Student Attendence Details</a></li>
        </ul>
    </div>
    @include('backend.partials._message')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <form action="#" method="post">
                       
                        <h2 style="text-align: center;">List of Class:9 Section:A. Date:01-10-2019</h2>
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                            <tr>
                                <th>Attendence Date</th>
                                <th>Student Rollgffgfg</th>
                                <th>Attendence</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($attendences as $attendence)
                            <tr>
                                <td>
                                   {{$attendence->created_at}}
                                </td>
                                <td>
                                   {{$attendence->roll}}
                                </td>
                                <td>
                                    <fieldset class="form-group">
                                    <div class="animated-checkbox">
                                        <label>
                                            <button class="btn btn-danger btn-xs">{{$attendence->attendence}}</button>
                                            <a href="#" class="btn btn-warning btn-xs">update</a>
                                        </label>
                                    </div>
                                    </fieldset>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </form>
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
