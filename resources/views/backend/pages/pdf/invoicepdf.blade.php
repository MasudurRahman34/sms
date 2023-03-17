<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Create Invoice</title>
</head>
<body>
<main class="app-content">
      <div class="app-title">
        <div class="app-breadcrumb breadcrumb">
           <h4 class="text-center">Center aligned text.</h4>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <section class="invoice">
              <div class="row mb-4">
                <div class="col-6">
                  <h2 class="page-header"><i class="fa fa-globe"></i>{{$students->schoolBranch->nameOfTheInstitution}}</h2>
                </div>
                <div class="col-6">
                  <h5 class="text-right">Date: {{$students->created_at}}</h5>
                </div>
              </div>
              <div class="row invoice-info">
                <div class="col-4">From
                  <address><strong>{{$users->name}}</strong><br>Address: Akshar Avenue<br>New Delhi<br>Email: hello@vali.com</address>
                </div>
                <div class="col-4">To
                  <address><strong>{{$students->firstName }} {{$students->lastName}}</strong><br>{{$students->Section->classes->className}}, {{$students->group}}, {{$students->Section->sectionName}}<br>Roll<br>{{$students->roll}},{{$students->Section->shift}},{{$students->Section->sessionYear->sessionYear}}<br>{{$students->schoolarshipStatus==0 ? "N/A" : "Yes"}},{{$students->blood}}<br>{{$students->birthDate}},{{$students->type}}<br>{{$students->mobile}},{{$students->readablePassword}}<br>Email: {{$students->email}}</address>
                </div>
                <div class="col-4"><b>Invoice #007612</b><br><br><b>Schoolarship Type:Telentpul</br>Amount: 4F3S8J<br><b>Payment Due:67666</b><br><b>Total Amount:</b> 968-34567</div>
              </div>
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Fee Name</th>
                        <th>Paid Month</th>
                        <th>Amount</th>
                        <th>Due Payment</th>
						<th>Total Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>John Doe Khan</td>
                        <td>JANUARY</td>
                        <td>500</td>
                        <td>200</td>
                        <td>300</td>
                      </tr>
                       <tr>
                        <td>Hellary Duff Khan</td>
                        <td>JANUARY</td>
                        <td>500</td>
                        <td>200</td>
                        <td>300</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="row d-print-none mt-2">
                <div class="col-12 text-right"><a class="btn btn-primary" href="javascript:window.print();" target="_blank"><i class="fa fa-print"></i> Print</a></div>
              </div>
            </section>
          </div>
        </div>
      </div>
    </main>
    <!-- {{-- @endforeach --}} -->


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>
