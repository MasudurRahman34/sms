
<style>
	table, th, td {
	  border: 1px solid black;
	  border-collapse: collapse;
	}
	th, td{
		padding: 5px;
  text-align: right;
  }
  h1,h2,h3,h4,h5,h6{
	  margin-top: 20px;
  }
  /* .image img{
	display: block;
	max-width: 100%;
	max-height: 100%;
	padding: 5px;
	margin-top: -185px;
	border: 1px solid black;
    padding: 5px;
	} */
	
</style>
	
<div class="row justify-content-md-center" id="print_div">
	<div class="col-md-12 mb-3">
		<div class="text-center">
			<input type='button' class="btn btn-warning"  value=' Print ' id='doPrint'>
		</div>	
	</div>
	@php
		$i=0;
	@endphp
	@foreach ($class as $student)
		@php $i++ @endphp
		
		
	<div class="col-md-10">
	  <div class="tile" style="border-style: solid;
								border-width: 5px;
								border-color:green;">
		<div class="tile-body">
			<div class="row justify-content-md-center">
				<div  class="col-md-12">
					<div class="text-center">
						<div class="row justify-content-end">
							<div class="col-12">
								<div id="headertop" class="">
									<h1>{{Auth::guard('web')->user()->schoolBranch->nameOfTheInstitution}}</h2>
									<h4>{{Auth::guard('web')->user()->schoolBranch->address}}</h5>
									<h3>Seat Plan (Room-{{$room}})</h4>
									<h4>{{$examName}}-{{date('Y')}}</h5>
								</div>
								{{-- <div class="image float-right">
									<img src="{{asset('students/passport2.jpeg')}}" alt="" width="200" height="200" >
								</div> --}}
							</div>
						</div>
				  	</div>
				  </div>
				  <div class="col-md-12 mt-2">
					<div style="overflow-x:auto;">
						<table style="width:100%">
							<tr>
							<th >Name:</th>
							<td>{{$student->firstName}} {{$student->lastName}} </td>
							<th>SID :</th>
							<td>{{$student->studentId}}</td>
							</tr>
							<tr>
								<th>Class :</th>
								<td>{{$student->Section->classes->className}} </td>
								<th>Session :</th>
								<td>{{$student->Section->sessionYear->sessionYear}} </td>
							</tr>
							<tr>
								<th>Roll :</th>
								<td>{{$student->roll}} </td>
								<th>Section :</th>
								<td>{{$student->Section->sectionName}} </td>
							</tr>
							<tr>
								<th>Group :</th>
								<td>{{$student->group}}</td>
								<th>Shift :</th>
								<td>{{$student->Section->shift}}</td>
							</tr>
						</table>
					</div>
				  </div>
				  <div class="col-md-12 mtb-2">
						<ul>
							<li>Stundent Must Bring Admit Card In The Examination Room</li>
							<li>Mobile Phone Resticted Around School Area.</li>
						</ul>
					</div>
					<div class="col-md-12 mtb-2">
						<div id="signature" class="float-left">
							<h6>Principal</h6>
						</div>
						<div id="signature" class="float-right">
							<h6>Exam Controller</h6>
						</div>
					</div>
					<div class="col-md-12 mtb-2">
						<div id="footer" class="text-center">
							<h6>{{Auth::guard('web')->user()->schoolBranch->nameOfTheInstitution}}</h6>
						</div>
					</div>
				</div>
			</div>
		</div>
	  </div>
	  @endforeach
	  
	</div>
  </div>
<script>

//print button in table
    $('#doPrint').on("click", function () {
        $('#print_div').printThis({
            debug: false,               // show the iframe for debugging
            importCSS: true,            // import parent page css
            importStyle: true,         // import style tags
            printContainer: true,       // print outer container/$.selector
            loadCSS: "",                // path to additional css file - use an array [] for multiple
            pageTitle: "",              // add title to print page
            removeInline: false,        // remove inline styles from print elements
            removeInlineSelector: "*",  // custom selectors to filter inline styles. removeInline must be true
            printDelay: 533,            // variable print delay
            header: null,               // prefix to html
            footer: null,               // postfix to html
            base: false,                // preserve the BASE tag or accept a string for the URL
            formValues: true,           // preserve input/form values
            canvas: false,              // copy canvas content
            doctypeString: '...',       // enter a different doctype for older markup
            removeScripts: false,       // remove script tags from print content
            copyTagClasses: false,      // copy classes from the html & body tag
            beforePrintEvent: null,     // function for printEvent in iframe
            beforePrint: null,          // function called before iframe is filled
            afterPrint: null            // function called before iframe is removed
        });
      });
    </script>

    