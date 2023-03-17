<!DOCTYPE html>
<html>
<head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="_token" content="{{ csrf_token() }}">
	<title>@yield('title')</title>
 	@include ('backend.partials.css')
  </head>
   <body class="app sidebar-mini rtl">
        @include ('backend.partials.header')

        <!-- Navbar-->
        @include ('backend.partials.sidebar')
        <main class="app-content">
            {{-- //global modal button in header --}}
            <div class="modal fade bd-example-modal-xl" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalScrollableTitle">User Manual</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                              <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-Admission" role="tab" aria-controls="nav-Admission" aria-selected="true">Admission</a>
                              <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-User" role="tab" aria-controls="nav-User" aria-selected="false">Add User</a>
                              <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-ClassTeacher" role="tab" aria-controls="nav-ClassTeacher" aria-selected="false">Class Teacher</a>
                              <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-Fee" role="tab" aria-controls="nav-Fee" aria-selected="false">Fee Collection</a>
                              <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-Mark" role="tab" aria-controls="nav-Mark" aria-selected="false">Mark Entry</a>
                              <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-Notification" role="tab" aria-controls="nav-Notification" aria-selected="false">Notification</a>
                            </div>
                          </nav>
                          <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-Admission" role="tabpanel" aria-labelledby="nav-home-tab"><p class="mt-1 text-bold"> <p>First Need To Create the Following Options </p><hr>
                                <ol>

                                    <li>Create Session/Year</li>
                                    <li>Create Class</li>
                                    <li>Create Section</li>
                                    <li>Create Subject</li>
                                    <li>Create Fee</li>
                                    <li>Create Schoolarship</li>
                                    <li>Go To Admission Section</li>
                                </ol>
                            </div>
                            <div class="tab-pane fade" id="nav-User" role="tabpanel" aria-labelledby="nav-profile-tab">Create User</div>
                            <div class="tab-pane fade" id="nav-ClassTeacher" role="tabpanel" aria-labelledby="nav-contact-tab">Class Teacher</div>
                            <div class="tab-pane fade" id="nav-Fee" role="tabpanel" aria-labelledby="nav-contact-tab">Fee</div>
                            <div class="tab-pane fade" id="nav-Mark" role="tabpanel" aria-labelledby="nav-contact-tab">Mark</div>
                            <div class="tab-pane fade" id="nav-Notification" role="tabpanel" aria-labelledby="nav-contact-tab">Notification</div>
                          </div>

                    </div>
                    <div class="modal-footer">
                      {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary">Save changes</button> --}}
                    </div>
                  </div>
                </div>
              </div>

                {{-- end global modal --}}
            @yield('content')

        </main>

        @include ('backend.partials.js.script')
        @yield('script')
    </body>
</html>
