<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title></title>

</head>
<body>
    <div class="row">
        <div class="col-md-12">
            @foreach ($user as $user)


            <div class="text-center m-5">
                <h1 class="text-warning">{{$user->nameOfTheInstitution}}</h1>
                <hr>
            </div>
        </div>
    </div>
        <table class="table table-striped" id="">
        <tr>
            <th>Admin Name:</th>
            <td>{{$user->name}}</td>
        </tr>
        <tr>
            <th>Email:</th>
            <td>{{$user->email}}</td>
        </tr>
        <tr>
            <th>Mobile Number:</th>
            <td>{{$user->mobile}}</td>
        </tr>
        <tr>
            <th>Password</th>
            <td>{{$user->readablePassword}}</td>
        </tr>
        <tr>
            <th>Designation</th>
            <td>{{$user->designation}}</td>
        </tr>
        <tr>
            <th>Adderss</th>
            <td>{{$user->address}}</td>
        </tr>
        <tr>
            <th>Join Date</th>
            <td>{{$user->created_at}}</td>
        </tr>


    </table>

    @endforeach
    <h6 class="text-center m-5 text-success">Thanks for being with us !! <br></h6>
    <a class="float-right" href="www.schoolmanagement.com">www.schoolmanagement.com</a>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>
