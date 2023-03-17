@extends('backend.student.layouts.master')
	@section('title', 'Student Dashboad')
    @section('content')
    <div class="app-title">
    <div class="col-md-12">
          <nav class="navbar navbar-expand-lg navbar-light bg-light">
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <a class="navbar-brand" href="#"><img style="height:7%; width:7%;" src="{{asset('student/images/sirclelogo1.png')}}"></a>
            
              <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                  <ul class="nav navbar-nav">
                     
                    </ul>
                <ul class=" nav navbar-nav ml-auto">
                  <li class="nav-item active">
                    <a class="nav-link" href="index.html">Home <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Academic</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link disabled" href="#">Administration</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link disabled" href="about.html">About</a>
                  </li>
                  <li class="nav-item">
                        <a class="nav-link disabled" href="#">Result</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link disabled" href="gallery.html">Gallery</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link disabled" href="#">Account</a>
                  </li>
                </ul>
              </div>
            </nav>
          </div>
    </div>
      <!-- Will be applied progress bar -->
      

      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body bg-purple">
                <h5 style="color:MediumSeaGreen;"><marquee behavior="alternate">Education is the key to unlocking the world, a passport to freedom.</marquee></h5>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
             <div class="row">
               <div class="col-md-6">
                <div class="tile">
                  <div>
                    <!-- Start WOWSlider.com BODY section -->
                    <link rel="stylesheet" type="text/css" href="https://wowslider.com/sliders/demo-70/engine1/style.css">
                    <div id="wowslider-container1">
                    <div class="ws_images">
                      <ul>
                        <li>
                          <img src="{{asset('student/images/event1.png')}}" alt="Cascade in the jungle html5 photo gallery " title="First event in 2018" id="wows1_0">
                        </li>
                        <li>
                          <img src="{{asset('student/images/eventtt1.png')}}" alt="Cityscape, Thailand html5 image gallery " title="Second event in 2018" id="wows1_1">
                        </li>
                        <li>
                          <img src="{{asset('student/images/eventtt2.png')}}" alt="Hermit crab photo gallery html5 " title="Firewall event in 2018" id="wows1_2">
                        </li>
                        <li>
                          <img src="{{asset('student/images/event4.png')}}" alt="Islands html5 photo gallery template " title="Islands" id="wows1_3"></li>
                        <li>
                          <img src="{{asset('student/images/event5.jpg')}}" alt="ard html5 gallery template " title="Hidden lizard" id="wows1_4">
                        </li>
                        <li>
                          <img src="{{asset('images/event6.png')}}" alt="Amazing nature gallery html5 " title="Amazing nature" id="wows1_5">
                        </li>
                        <li>
                          <img src="{{asset('student/images/event7.png')}}" alt="Stream image gallery html5 " title="Stream" id="wows1_6">
                        </li>
                        <li>
                          <img src="{{asset('student/images/event8.png')}}" alt="Fantastic view free html5 gallery " title="Fantastic view" id="wows1_7">
                        </li>
                      </ul>
                    </div>
                    <div class="ws_thumbs">
                      <div>
                        <a href="#" title="Cascade in the jungle"><img src="{{asset('student/images/event1.png')}}" alt="html5 web gallery ">1 </a>
                        <a href="#" title="Cityscape, Thailand"><img src="{{asset('student/images/event2.png')}}" alt="html5 photo gallery free ">2 </a>
                        <a href="#" title="Hermit crab"><img src="{{asset('student/images/event3.jpg')}}" alt="html5 gallery free ">3 </a>
                        <a href="#" title="Islands"><img src="{{asset('student/images/event4.png')}}" alt="free html5 photo gallery  ">4 </a>
                        <a href="#" title="Hidden lizard"><img src="{{asset('student/images/event5.jpg')}}" alt="html5 gallery code  ">5 </a>
                        <a href="#" title="Amazing nature"><img src="{{asset('student/images/event6.png')}}" alt="html5 photo gallery code  ">6 </a>
                        <a href="#" title="Stream"><img src="{{asset('student/images/event7.png')}}" alt="photo gallery html5 template  ">7 </a>
                        <a href="#" title="Fantastic view"><img src="{{asset('student/images/event8.png')}}" alt="html5 image gallery template  ">8 </a>
                      </div>
                    </div>
                    <span class="wsl"><a href="https://wowslider.com">html5 gallery</a></span>
                    <div class="ws_shadow"></div>
                    </div>
                    <br>
                  </div>
                </div>
        </div>
        <div class="col-md-6">
          <div class="tile">
            <div class="container">
              <h1 class="jumbotron-heading text-center">Students Alumni Congress</h1>
              <hr>
              <p class="lead text-muted">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don’t simply skip over it entirely. Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don’t simply skip over it entirely.</p><br>
              <p class="lead text-muted">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don’t simply skip over it entirely. Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don’t simply skip over it entirely.</p><br>
              <p class="lead text-muted">below—its contents, the creator, etc. Make it short and sweet, but not too short </p><br>
              <p style="color:green !important;" class="lead text-muted">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet. below—its contents, the creator, etc. Make it short and sweet</p>
            </div>
          </div>
        </div>
             </div>
          </div> 
      </div>
    </div>

    <div class="tile">
      <h2 class="text-primary text-center">Let's Go To See More Events</h2><br>
       <div class="row">
          <div class="col-xs-12 col-sm-6 col-md-4">
              <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
                  <div class="mainflip">
                    <div class="frontside">
                        <div class="card">
                            <div class="card-body text-center">
                                <p><img class=" img-fluid" src="{{asset('student/images/upevent1.jpg')}}" alt="card image"></p>
                                <h4 class="card-title">Shuvo Ahmed (Alien Coder)</h4>
                                <p class="card-text">A good teacher can inspire hope, ignite the imagination, and instill a love of learning.</p>
                                <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                    </div>
                      <div class="backside">
                        <div class="card">
                          <div class="card-body text-center mt-4">
                            <h4 class="card-title">Shuvo Ahmed</h4>
                            <p class="card-text">I think that life is difficult. People have challenges. Family members get sick, people get older, you don't always get the job or the promotion that you want. You have conflicts in your life. And really, life is about your resilience and your ability to go through your life and all of the ups and downs with a positive attitude.</p>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a class="social-icon text-xs-center" target="_blank" href="#">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="social-icon text-xs-center" target="_blank" href="#">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="social-icon text-xs-center" target="_blank" href="#">
                                        <i class="fa fa-skype"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="social-icon text-xs-center" target="_blank" href="#">
                                        <i class="fa fa-google"></i>
                                    </a>
                                </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                  </div>
              </div>
            </div>
            <!-- second -->
            <div class="col-xs-12 col-sm-6 col-md-4">
              <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
                <div class="mainflip">
                  <div class="frontside">
                      <div class="card">
                          <div class="card-body text-center">
                              <p><img class=" img-fluid" src="{{asset('student/images/upevent2.jpg')}}" alt="card image"></p>
                              <h4 class="card-title">Mishuk Rahman (Vip guest)</h4>
                              <p class="card-text">Any good teacher knows how important it is to connect with students and understand our culture.</p>
                              <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></a>
                          </div>
                      </div>
                  </div>
                  <div class="backside">
                    <div class="card">
                      <div class="card-body text-center mt-4">
                        <h4 class="card-title">Mishuk Rahman</h4>
                        <p class="card-text">Stay positive and happy. Work hard and don't give up hope. Be open to criticism and keep learning. Surround yourself with happy, warm and genuine people.</p>
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <a class="social-icon text-xs-center" target="_blank" href="#">
                                    <i class="fa fa-facebook"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a class="social-icon text-xs-center" target="_blank" href="#">
                                    <i class="fa fa-twitter"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a class="social-icon text-xs-center" target="_blank" href="#">
                                    <i class="fa fa-skype"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a class="social-icon text-xs-center" target="_blank" href="#">
                                    <i class="fa fa-google"></i>
                                </a>
                            </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Thired -->
            <div class="col-xs-12 col-sm-6 col-md-4">
              <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
                <div class="mainflip">
                  <div class="frontside">
                      <div class="card">
                          <div class="card-body text-center">
                              <p><img class=" img-fluid" src="{{asset('student/images/pic2.jpg')}}" alt="card image"></p>
                              <h4 class="card-title">Shubir Ahmed</h4>
                              <p class="card-text">My mission in life is not merely to survive, but to thrive; and to do so with some passion, some compassion, some</p>
                              <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></a>
                          </div>
                      </div>
                  </div>
                  <div class="backside">
                    <div class="card">
                      <div class="card-body text-center mt-4">
                        <h4 class="card-title">Shubir Ahmed</h4>
                        <p class="card-text">You have to enjoy life. Always be surrounded by people that you like, people who have a nice conversation. There are so many positive things to think about.</p>
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <a class="social-icon text-xs-center" target="_blank" href="#">
                                    <i class="fa fa-facebook"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a class="social-icon text-xs-center" target="_blank" href="#">
                                    <i class="fa fa-twitter"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a class="social-icon text-xs-center" target="_blank" href="#">
                                    <i class="fa fa-skype"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a class="social-icon text-xs-center" target="_blank" href="#">
                                    <i class="fa fa-google"></i>
                                </a>
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
    <!-- Event article -->
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
