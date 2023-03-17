@extends('backend.student.layouts.master')
	@section('title', 'Student Dashboad')
    @section('content')
    <div class="app-title">
    <div class="col-md-12">

          <nav class="navbar navbar-expand-lg navbar-light bg-light">
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="row">
                <div class="col-md-7 col-sm-12"><a class="navbar-brand" href="#"><img style="height:15%; width:15%;" src="{{asset('student/images/sirclelogo1.png')}}"></a></div>
                <div class="col-md-5 mt-5">
              
            
              <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                  <!-- <ul class="nav navbar-nav">
                     
                    </ul> -->
                <ul class=" nav navbar-nav ml-auto">
                  <li class="nav-item {{Request::is('student/school/corner') ? 'active' : ''}}">
                    <a class="nav-link" href="/student/school/corner">Home <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Academic</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link disabled" href="#">Administration</a>
                  </li>
                  <li class="nav-item {{Request::is('student/school/about') ? 'active' : ''}}">
                      <a class="nav-link disabled" href="/student/school/about">About</a>
                  </li>
                  <li class="nav-item">
                        <a class="nav-link disabled" href="#">Result</a>
                  </li>
                  <li class="nav-item {{Request::is('student/school/gallery') ? 'active' : ''}}">
                      <a class="nav-link disabled" href="/student/school/gallery">Gallery</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link disabled" href="#">Account</a>
                  </li>
                </ul>
              </div>
            </nav>
          </div>
          </div>
              </div>
    </div>
      <!-- Will be applied progress bar -->
      

      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body bg-purple">
                <h5 style="color:MediumSeaGreen;"><marquee behavior="alternate">Education is the key to unlocking the world, a passport to freedom.</marquee></h5>
                <h6 style="text-align:center;color:blue;">Our gallery</h6>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="tile">
                 <!-- Grid row -->
                <div class="row">
                  <div class="col-lg-4 col-md-12 mb-4">

                    <!--Modal: Name-->
                    <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg" role="document">

                        <!--Content-->
                        <div class="modal-content">

                          <!--Body-->
                          <div class="modal-body mb-0 p-0">

                            <div class="embed-responsive embed-responsive-16by9 z-depth-1-half">
                             <iframe width="560" height="315" src="https://www.youtube.com/embed/SVuDbRcMcPQ" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>

                          </div>

                          <!--Footer-->
                          <div class="modal-footer justify-content-center">
                            <span class="mr-4">Spread the word!</span>
                            <a type="button" class="btn-floating btn-sm btn-fb"><i class="fab fa-facebook-f"></i></a>
                            <!--Twitter-->
                            <a type="button" class="btn-floating btn-sm btn-tw"><i class="fab fa-twitter"></i></a>
                            <!--Google +-->
                            <a type="button" class="btn-floating btn-sm btn-gplus"><i class="fab fa-google-plus-g"></i></a>
                            <!--Linkedin-->
                            <a type="button" class="btn-floating btn-sm btn-ins"><i class="fab fa-linkedin-in"></i></a>

                            <button type="button" class="btn btn-outline-primary btn-rounded btn-md ml-4" data-dismiss="modal">Close</button>

                          </div>

                        </div>
                        <!--/.Content-->

                      </div>
                    </div>
                    <!--Modal: Name-->

                    <a><img class="img-fluid z-depth-1" src="{{asset('student/images/g1.png')}}" alt="video"
                        data-toggle="modal" data-target="#modal1"></a>

                  </div>
                  <!-- Grid column -->

                  <!-- Grid column -->
                  <div class="col-lg-4 col-md-6 mb-4">

                    <!--Modal: Name-->
                    <div class="modal fade" id="modal6" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg" role="document">

                        <!--Content-->
                        <div class="modal-content">

                          <!--Body-->
                          <div class="modal-body mb-0 p-0">

                            <div class="embed-responsive embed-responsive-16by9 z-depth-1-half">
                              <iframe width="560" height="315" src="https://www.youtube.com/embed/9LsQbUav6mc" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>

                          </div>

                          <!--Footer-->
                          <div class="modal-footer justify-content-center">
                            <span class="mr-4">Spread the word!</span>
                            <a type="button" class="btn-floating btn-sm btn-fb"><i class="fab fa-facebook-f"></i></a>
                            <!--Twitter-->
                            <a type="button" class="btn-floating btn-sm btn-tw"><i class="fab fa-twitter"></i></a>
                            <!--Google +-->
                            <a type="button" class="btn-floating btn-sm btn-gplus"><i class="fab fa-google-plus-g"></i></a>
                            <!--Linkedin-->
                            <a type="button" class="btn-floating btn-sm btn-ins"><i class="fab fa-linkedin-in"></i></a>

                            <button type="button" class="btn btn-outline-primary btn-rounded btn-md ml-4" data-dismiss="modal">Close</button>

                          </div>

                        </div>
                        <!--/.Content-->

                      </div>
                    </div>
                    <!--Modal: Name-->

                    <a><img class="img-fluid z-depth-1" src="{{asset('student/images/g2.png')}}" alt="video"
                        data-toggle="modal" data-target="#modal6"></a>

                  </div>
                  <!-- Grid column -->

                  <!-- Grid column -->
                  <div class="col-lg-4 col-md-6 mb-4">

                    <!--Modal: Name-->
                    <div class="modal fade" id="modal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg" role="document">

                        <!--Content-->
                        <div class="modal-content">

                          <!--Body-->
                          <div class="modal-body mb-0 p-0">

                            <div class="embed-responsive embed-responsive-16by9 z-depth-1-half">
                             <iframe width="560" height="315" src="https://www.youtube.com/embed/pjDpL5vZ8oo" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>

                          </div>

                          <!--Footer-->
                          <div class="modal-footer justify-content-center">
                            <span class="mr-4">Spread the word!</span>
                            <a type="button" class="btn-floating btn-sm btn-fb"><i class="fab fa-facebook-f"></i></a>
                            <!--Twitter-->
                            <a type="button" class="btn-floating btn-sm btn-tw"><i class="fab fa-twitter"></i></a>
                            <!--Google +-->
                            <a type="button" class="btn-floating btn-sm btn-gplus"><i class="fab fa-google-plus-g"></i></a>
                            <!--Linkedin-->
                            <a type="button" class="btn-floating btn-sm btn-ins"><i class="fab fa-linkedin-in"></i></a>

                            <button type="button" class="btn btn-outline-primary btn-rounded btn-md ml-4" data-dismiss="modal">Close</button>

                          </div>

                        </div>
                        <!--/.Content-->

                      </div>
                    </div>
                    <!--Modal: Name-->

                    <a><img class="img-fluid z-depth-1" src="https://mdbootstrap.com/img/screens/yt/screen-video-3.jpg" alt="video"
                        data-toggle="modal" data-target="#modal4"></a>

                  </div>
                  <!-- Grid column -->
                </div>
                <!-- Grid row -->
            <!-- Grid row -->
            <div class="row">

              <!-- Grid column -->
              <div class="col-lg-4 col-md-12 mb-4">

                <!--Modal: Name-->
                <div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">

                    <!--Content-->
                    <div class="modal-content">

                      <!--Body-->
                      <div class="modal-body mb-0 p-0">

                        <div class="embed-responsive embed-responsive-16by9 z-depth-1-half">
                          <iframe width="560" height="315" src="https://www.youtube.com/embed/tu_em6uT3qY" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>

                      </div>

                      <!--Footer-->
                      <div class="modal-footer justify-content-center">
                        <span class="mr-4">Spread the word!</span>
                        <a type="button" class="btn-floating btn-sm btn-fb"><i class="fab fa-facebook-f"></i></a>
                        <!--Twitter-->
                        <a type="button" class="btn-floating btn-sm btn-tw"><i class="fab fa-twitter"></i></a>
                        <!--Google +-->
                        <a type="button" class="btn-floating btn-sm btn-gplus"><i class="fab fa-google-plus-g"></i></a>
                        <!--Linkedin-->
                        <a type="button" class="btn-floating btn-sm btn-ins"><i class="fab fa-linkedin-in"></i></a>

                        <button type="button" class="btn btn-outline-primary btn-rounded btn-md ml-4" data-dismiss="modal">Close</button>

                      </div>

                    </div>
                    <!--/.Content-->

                  </div>
                </div>
                <!--Modal: Name-->

                <a><img class="img-fluid z-depth-1" src="https://mdbootstrap.com/img/screens/yt/screen-video-4.jpg" alt="video"
                    data-toggle="modal" data-target="#modal2"></a>

              </div>
              <!-- Grid column -->

              <!-- Grid column -->
              <div class="col-lg-4 col-md-6 mb-4">

                <!--Modal: Name-->
                <div class="modal fade" id="modal5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">

                    <!--Content-->
                    <div class="modal-content">

                      <!--Body-->
                      <div class="modal-body mb-0 p-0">

                        <div class="embed-responsive embed-responsive-16by9 z-depth-1-half">
                          <iframe width="560" height="315" src="https://www.youtube.com/embed/Ed2KRddgv-4" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>

                      </div>

                      <!--Footer-->
                      <div class="modal-footer justify-content-center">
                        <span class="mr-4">Spread the word!</span>
                        <a type="button" class="btn-floating btn-sm btn-fb"><i class="fab fa-facebook-f"></i></a>
                        <!--Twitter-->
                        <a type="button" class="btn-floating btn-sm btn-tw"><i class="fab fa-twitter"></i></a>
                        <!--Google +-->
                        <a type="button" class="btn-floating btn-sm btn-gplus"><i class="fab fa-google-plus-g"></i></a>
                        <!--Linkedin-->
                        <a type="button" class="btn-floating btn-sm btn-ins"><i class="fab fa-linkedin-in"></i></a>

                        <button type="button" class="btn btn-outline-primary btn-rounded btn-md ml-4" data-dismiss="modal">Close</button>

                      </div>

                    </div>
                    <!--/.Content-->

                  </div>
                </div>
                <!--Modal: Name-->

                <a><img class="img-fluid z-depth-1" src="https://mdbootstrap.com/img/screens/yt/screen-video-5.jpg" alt="video"
                    data-toggle="modal" data-target="#modal5"></a>

              </div>
              <!-- Grid column -->

              <!-- Grid column -->
              <div class="col-lg-4 col-md-6 mb-4">

                <!--Modal: Name-->
                <div class="modal fade" id="modal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">

                    <!--Content-->
                    <div class="modal-content">

                      <!--Body-->
                      <div class="modal-body mb-0 p-0">

                        <div class="embed-responsive embed-responsive-16by9 z-depth-1-half">
                          <iframe width="560" height="315" src="https://www.youtube.com/embed/T50IvCSKB80" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>

                      </div>

                      <!--Footer-->
                      <div class="modal-footer d-block d-md-flex justify-content-center">
                        <span class="mr-4">Spread the word!</span>
                        <a type="button" class="btn-floating btn-sm btn-fb"><i class="fab fa-facebook-f"></i></a>
                        <!--Twitter-->
                        <a type="button" class="btn-floating btn-sm btn-tw"><i class="fab fa-twitter"></i></a>
                        <!--Google +-->
                        <a type="button" class="btn-floating btn-sm btn-gplus"><i class="fab fa-google-plus-g"></i></a>
                        <!--Linkedin-->
                        <a type="button" class="btn-floating btn-sm btn-ins"><i class="fab fa-linkedin-in"></i></a>

                        <button type="button" class="btn btn-outline-primary btn-rounded btn-md ml-4" data-dismiss="modal">Close</button>

                      </div>

                    </div>
                    <!--/.Content-->

                  </div>
                </div>
                <!--Modal: Name-->

                <a><img class="img-fluid z-depth-1" src="{{asset('student/images/g3.png')}}" alt="video"
                    data-toggle="modal" data-target="#modal3"></a>

              </div>
              <!-- Grid column -->

            </div>
            <!-- Grid row -->
          </div> 
      </div>
    </div>

   
    <!-- Event article -->
   <div class="bg-light">
    <!-- Teacher Section -->
    <div class="container space-2 space-md-3">
      <!-- Title -->
      <div class="w-md-80 w-lg-50 text-center mx-md-auto mb-9"><br>
        <h2 class="text-primary">Our Upcomig Events</h2><br>
      </div>
      <!-- End Title -->
        <div class="row"> 
          <div class="col-md-4">
            <div class="card" style="width: 18rem;">
              <img src="{{asset('student/images/event3.jpg')}}" class="card-img-top" alt="img">
                <div class="card-body">
                  <h5 class="card-title text-center">school Alumni</h5>
                  <p class="card-text">A man who has never gone to school may steal from a freight car; but if he has a university education,man who has never gone to s  he may steal the whole railroad.</p>
                  <a href="{{route('event.details')}}" class="btn btn-primary text-center">Go Details>></a>
                </div>
            </div>
             </div>
              <div class="col-md-4">
            <div class="card" style="width: 18rem;">
              <img src="{{asset('student/images/event2.png')}}" class="card-img-top" alt="img">
                <div class="card-body">
                  <h5 class="card-title text-center">Alumni Association Membership</h5>
                  <p class="card-text">A man who has never gone to school may steal from a freight car; but if he has a university education, he may steal the whole railroad.</p>
                  <a href="{{route('event.details')}}" class="btn btn-primary text-center">Go Details>></a>
                </div>
            </div>
          </div>
           <div class="col-md-4">
            <div class="card" style="width: 18rem;">
              <img src="{{asset('student/images/event1.png')}}" class="card-img-top" alt="img">
                <div class="card-body">
                  <h5 class="card-title text-center">School Firewall</h5>
                  <p class="card-text">A man who has never gone to school may steal from a freight car; but if he has a university education, he may steal the whole railroad.</p>
                  <a href="{{route('event.details')}}" class="btn btn-primary text-center">Go Details>></a>
                </div>
            </div> 
            </div>              
        </div>
    </div>
  </div>
<br>
<!-- start fotter -->
<div class="mt-5 badge-dark">
<!-- Footer -->
<!-- Footer -->
<footer class="page-footer font-small blue-grey lighten-5">
  <div style="background-color: #21d192;">
    <div class="container">
      <!-- Grid row-->
      <div class="row py-4 d-flex align-items-center">
        <!-- Grid column -->
        <div class="col-md-6 col-lg-5 text-center text-md-left mb-4 mb-md-0">
          <h6 class="mb-0">Education is the premise of progress, in every society, in every family!</h6>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-6 col-lg-7 text-center text-md-right">

          <!-- Facebook -->
          <a class="btn-floating btn-large btn-fb">
            <a href="https://www.facebook.com/"><i class="fa fa-facebook" aria-hidden="true"></i></a>

          </a>
          <!-- Twitter -->
          <a class="btn-floating btn-large btn-tw">
            <a href="https://twitter.com/"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
          </a>
          <!-- Google +-->
          <a class="btn-floating btn-large btn-gplus">
            <a href="https://www.google.com/"><i class="fab fa-google-plus-g white-text mr-4"> </i></a>
          </a>
          <!--Linkedin -->
          <a class="btn-floating btn-large btn-li">
            <a href="https://bd.linkedin.com/"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
          </a>
          <!--Instagram-->
          <a class="btn-floating btn-large btn-ins">
            <a href="https://www.instagram.com/"><i class="fa fa-instagram" aria-hidden="true"></i></a>
          </a>

        </div>
        <!-- Grid column -->

      </div>
      <!-- Grid row-->

    </div>
  </div>

  <!-- Footer Links -->
  <div class="container text-center text-md-left mt-5">

    <!-- Grid row -->
    <div class="row mt-3 dark-grey-text">

      <!-- Grid column -->
      <div class="col-md-3 col-lg-4 col-xl-3 mb-4">

        <!-- Content -->
        <h6 class="text-uppercase font-weight-bold">Ignight Standard School</h6>
        <hr class="teal accent-3 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
        <p>Education is not just about going to school and getting a degree. It's about widening your knowledge and absorbing the truth about life.</p>
        <br>
          <p>Education is not just about going to school and getting a degree.</p>

      </div>
      <!-- Grid column -->

      <!-- Grid column -->
      <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">

        <!-- Links -->
        <h6 class="text-uppercase font-weight-bold">Quick Links</h6>
        <hr class="teal accent-3 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
        <p>
          <a class="dark-grey-text" href="#!">MyIgnight</a>
        </p>
        <p>
          <a class="dark-grey-text" href="#!">Prospective Students</a>
        </p>
        <p>
          <a class="dark-grey-text" href="#!">Current Students</a>
        </p>
        <p>
          <a class="dark-grey-text" href="#!">Faculty & Staff</a>
        </p>

      </div>
      <!-- Grid column -->

      <!-- Grid column -->
      <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">

        <!-- Links -->
        <h6 class="text-uppercase font-weight-bold">Useful links</h6>
        <hr class="teal accent-3 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
        <p>
          <a class="dark-grey-text" href="#!">Your Account</a>
        </p>
        <p>
          <a class="dark-grey-text" href="#!">Become an Affiliate</a>
        </p>
        <p>
          <a class="dark-grey-text" href="#!">Privacy Policy</a>
        </p>
        <p>
          <a class="dark-grey-text" href="#!">Help</a>
        </p>

      </div>
      <!-- Grid column -->

      <!-- Grid column -->
      <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">

        <!-- Links -->
        <h6 class="text-uppercase font-weight-bold">Contact</h6>
        <hr class="teal accent-3 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
        <p>
          <i class="fa fa-address-book-o" aria-hidden="true"></i> New York, NY 10012, US
        </p>
        <p>
          <i class="fa fa-envelope" aria-hidden="true"></i> quadinfo@example.com
        </p>
        <p>
          <i class="fa fa-phone-square" aria-hidden="true"></i> + 01 234 567 88
        </p>
        <p>
          <i class="fa fa-fax" aria-hidden="true"></i> + 01 234 567 89
        </p>
      </div>
      <!-- Grid column -->

    </div>
    <!-- Grid row -->

  </div>
  <!-- Footer Links -->

  <!-- Copyright -->
  <div class="footer-copyright text-center text-success-50 py-3">© 2018 Copyright By:
    <a class="dark-grey-text" href="https://http://quadinfoltd.com//">Quadinfoltd.com</a>
  </div>
  <!-- Copyright -->

</footer>
<!-- Footer -->
</div>

      
     
    @endsection
    @section('script')
      {{-- @include('backend.partials.js.datatable'); --}}
      <script>
     </script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.0/jquery.js"></script> -->
@endsection
