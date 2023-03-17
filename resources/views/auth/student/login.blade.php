<!DOCTYPE html>
<html lang="en">
<head>

  <title>School ERP</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link href="http://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">

  {{-- <link rel="stylesheet" type="text/css" href="css/style.css"> --}}
</head>
<body>

<div class="container-fluid">
    <div class="jumbotron jumbotron-fluid">
          <div class="row">
            <div class="col-md-6">
             <a href={{url('/')}}><h4 class="text-center text-uppercase">School Management System</h4></a>
            </div>
            <div class="col-md-6">
                <form class="form-inline" style="margin: auto; width:70%"  method="POST" action="{{ route('student.login') }}">
                    @csrf
                    <input type="text" value="01904470171" class="form-control mb-2 mr-sm-2" name="email" id="email" placeholder="Enter Your Email Or Number" value="{{ old('email') }}">

                    <div class="input-group mb-2 mr-sm-2">
                      <div class="input-group-prepend">
                      </div>
                      <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="989104">
                    </div>



                    <button type="submit" class="btn btn-success mb-2" style="width: 230px;">Submit</button>
                  </form>
              </div>

          <!-- <h1 class="display-4">Fluid jumbotron</h1>
          <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p> -->
        </div>
      </div>
</div>

<div class="container-fluid bg-3">
  <div class="row">
    <div class="col-sm-6 text-center">
      <!-- <p class="mt-5">Education Is The Most Powerful Weapon Which You Can Use To Change The World !!</p> -->
      <img src="{{ asset('images/login_image.png') }}" class="img-responsive margin" style="width:70%" alt="Image">
    </div>
    <div class="col-sm-6">
    <h3 class="login-head mb-5"><i class="fa fa-graduation-cap" aria-hidden="true"></i>Success Notes</h3>
    <hr>
    <ul class="list-group list-group-flush">
  <li class="list-group-item">Challenges are what make life interesting. Overcoming them is what makes life meaningful. – Joshua J. Marine</li>
  <li class="list-group-item">I’ve failed over and over and over again in my life. And that is why I succeed. – Michael Jordan</li>
  <li class="list-group-item">I don’t measure a man’s success by how high he climbs, but how high he bounces when he hits the bottom. – George S. Patton</li>
  <li class="list-group-item">If you’re going through hell, keep going. – Winston Churchill</li>
  <li class="list-group-item">Don’t let your victories go to your head, or your failures go to your heart.</li>
  <li class="list-group-item">Failure is the opportunity to begin again more intelligently. – Henry Ford</li>
</ul>
    
    
     <!-- <form class="login-form mt-5 mb-5" style="margin: auto; width:70%" action="#">

          <h3 class="login-head mb-5"><i class="fa fa-graduation-cap" aria-hidden="true"></i>Apply For Service</h3>
          <div class="form-group">
            <input class="form-control" type="text" name="institute" id="institute" placeholder="Name Of The Institute" autofocus>
          </div>
          <div class="form-group">
            <input class="form-control" type="text" name="eiin" id="eiin" placeholder="EIIN Number" autofocus>
          </div>
          <div class="form-group">
            <input class="form-control" type="number" name="phone" placeholder="Phone No" autofocus>
          </div>
           <div class="form-group">
            <input class="form-control" type="text" name="district" id="district" placeholder="District" autofocus>
          </div>
          <div class="form-group">
            <input class="form-control" type="text" name="address" id="address" placeholder="Address" autofocus>
          </div>

          <div class="form-group">
            <input class="form-control" type="text" name="principal" id="principal" placeholder="Name Of The Principal" autofocus>
          </div>
          <div class="form-group">
            <select class="form-control" id="sectionClass">
              <option value="1">Boalmari Upazila</option>
              <option value="2">Bhanga Upazila</option>
              <option value="3">Bhanga Upazila</option>
              <option value="4">Bhanga Upazila</option>
              <option value="5">Bhanga Upazila</option>
            </select>
          </div>
          <fieldset class="form-group">
            <legend>School Type</legend>
            <div class="form-check">
              <label class="form-check-label">
                <input class="form-check-input" id="1" type="radio" name="schoolType" value="option1" checked="">Public Schools
              </label>
              &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
              <label class="form-check-label">
                <input class="form-check-input" id="2" type="radio" name="schoolType" value="option1">Private School
              </label>
              &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
            </div>
          </fieldset>
          <div class="form-group btn-container">
            <button class="btn btn-success btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>Sent Request</button>
          </div>
          <br>
        </form> -->
        
    </div>

  </div>
</div>

<!-- Second Container -->

<!-- Third Container (Grid) -->


<!-- Footer -->
<footer class="container-fluid bg-4 text-center">
  <p>School Management | Developed By <a href="#">MASUDUR RAHMAN SHUVO</a></p>
</footer>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
