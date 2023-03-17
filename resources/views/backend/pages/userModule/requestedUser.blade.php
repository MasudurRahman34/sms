@extends('backend.layouts.master')
	@section('title', 'Home Page')
    @section('content')
    <div class="app-title">
        <div>
          <h1><i class="fa fa-edit"></i> Requested Users</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Home</li>
          <li class="breadcrumb-item"><a href="#">Requested Users</a></li>
        </ul>
    </div>
    <div class="col-md-12 col-sm-12">
        <div class="tile">
          <div class="tile-body">
            <div class="table-responsive">
            <table class="table table-hover table-bordered" style="background-color:" id="requestedUserData">
              <thead>
                <tr>
                  <th>School Type</th>
                  <th>Institution Name</th>
                  <th>Eiin Number</th>
                  <th>Head Name</th>
                  <th>Phone Number</th>
                  <th>Email</th>
                  <th>District</th>
                  <th>Upozilla</th>
                  <th>Address</th>
                  <th>Status</th>
                  <th>Date</th>
                  <th>Action</th>
                </tr>
              </thead>
            </table>
          </div>
          </div>
        </div>
      </div>
  </div>
  <div class="clearix"></div>
  <button type="button" data-toggle="modal" data-target="#myModal" hidden>Launch modal</button>
  <div class="modal fade bd-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
            <div class="row" id="printDiv">
                    <div class="col-md-12">
                        <button class="m-5 float-right" id="btnPrint">print me</button>
                        <div class="text-center m-5">
                            <h1 class="text-warning" id="schoolName">{{'school name'}}</h1>
                            <hr>
                        </div>
                    </div>
                    <div class="col-md-12" id="printDiv">
                        <div class="p-5">
                        <div class="table-responsive">
                        <table class="table table-striped" id="">
                            <tr>
                                <th>Admin Name:</th>
                                <td id="name"></td>
                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td id="email"></td>
                            </tr>
                            <tr>
                                <th>Mobile Number:</th>
                                <td id="mobile"></td>
                            </tr>
                            <tr>
                                <th>Password</th>
                                <td id="password"></td>
                            </tr>
                            <tr>
                                <th>Designation</th>
                                <td id="designation"></td>
                            </tr>
                            <tr>
                                <th>Adderss</th>
                                <td id="address"></td>
                            </tr>
                            <tr>
                                <th>Join Date</th>
                                <td id="created_at"></td>
                            </tr>
                    </table>
                    </div>
                    <h6 class="text-center m-5 text-success">Thanks for being with us !! <br></h6>
    <a class="float-right" href="www.schoolmanagement.com">www.schoolmanagement.com</a>
                </div>
            </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
  @include('backend.partials.js.datatable');
  <script>
      $(document).ready( function () {
        $('#requestedUserData').DataTable({
            dom: 'lBfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf',
                {
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                        }
                },
                'colvis',
            ],
            columnDefs: [ {
                // targets: -1,
                visible: false
            } ],
             processing:true,
             serverSide:true,
             ajax:"{{url('/requestedUserData')}}",
             columns:[
                 { data: 'schoolType', name: 'schoolType' },
                 { data: 'nameOfTheInstitution', name: 'nameOfTheInstitution' },
                 { data: 'eiinNumber', name: 'eiinNumber' },
                 { data: 'nameOfHead', name: 'nameOfHead' },
                 { data: 'district', name: 'district' },
                 { data: 'phoneNumber', name: 'phoneNumber' },
                 { data: 'email', name: 'email' },
                 { data: 'upazilla', name: 'upazilla' },
                 { data: 'address', name: 'address' },
                 { data: 'Status', name: 'Status' },
                 { data: 'created_at', name: 'created_at' },
                 { data: 'action', name: 'action' }
             ]
         });
        });



    function btnAccept(id) {
        console.log(id);
        swal({
            title: "Are You Sure !",
            text: "Make The School As Our User",
            type: "warning",
            confirmButtonText: "Confirm !",
            cancelButtonText: "No !",
            showCancelButton: true,
            closeOnConfirm: true,
            closeOnCancel: true,
            dangerMode: true,
        }, function(isConfirm) {
            if (isConfirm) {
                $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
            });
                $.ajax({
                    type: "post",
                    url: "{{url('/addSchoolBranch/store')}}",
                    data: {id:id,},
                    success: function (data) {
                        console.log(data);
                        $('#myModal').modal('show');
                        $('#name').html(data.user['name']);
                        $('#email').html(data.user['email']);
                        $('#mobile').html(data.user['mobile']);
                        $('#password').html(data.user['readablePassword']);
                        $('#designation').html(data.user['designation']);
                        $('#address').html(data.user['address']);
                        $('#created_at').html(data.user['created_at']);
                        $('#schoolName').html(data.schoolName);
                    }
                });
            }else{
                swal("Your imaginary file is safe!");
            }
            });
        }
    function btnDecline(id) {
        console.log(id);
    }


    document.getElementById("btnPrint").addEventListener("click", function (event) {
        event.preventDefault()
      var printContents = document.getElementById('printDiv').innerHTML;
      var originalContents = document.body.innerHTML;
      document.body.innerHTML = printContents;
      window.print();
      document.body.innerHTML = originalContents;
    });

  </script>

@endsection

