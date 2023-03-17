
<style>
	
	table, th, td {
	  /* border: 1px solid black; */
	  border-collapse: collapse;
	}
.table th{
		padding: 5px;
  		text-align: center;
  }
  .table td{
	  padding: 5px;
	  text-align: center;
  }
  #studenttable .table, .table th, .table td{
		border:none;
		border-collapse: collapse;
				}
</style>

		<div class="row justify-content-md-center" id="print_div">
			<div class="col-md-12 mb-3">
				<div class="text-center">
					<input type='button' class="btn btn-warning"  value=' Print ' id='doPrint'>
				</div>	
			</div>
			
				<div class="col-md-12" id="resultDiv">
					<div class="tile" style="border-style: solid;
					border-width: 5px;
					border-color:green;">
						{{-- <h3 class=""><center><b id="name">  </b>  &nbsp Exam Result</center></h3> --}}
						<div class="row justify-content-md-center">
							<div  class="col-md-12">
								<div class="text-center">
									<div class="row justify-content-end">
										<div class="col-12">
											<div id="headertop" class="">
												<h1>{{Auth::guard('web')->user()->schoolBranch->nameOfTheInstitution}}</h2>
												<h4>{{Auth::guard('web')->user()->schoolBranch->address}}</h5>
													<hr class="m-2">
												{{-- <h3>Admit Card</h4>
												<h4>-{{date('Y')}}</h5> --}}
											</div>
											{{-- <div class="image float-right">
												<img src="{{asset('students/passport2.jpeg')}}" alt="" width="200" height="200" >
											</div> --}}
										</div>
									</div>
								  </div>
							  </div>
							  <div class="col-12 mb-4">
								<div style="overflow-x:auto;">
									<table style="width:100%" id="studenttable">
										@if ($students)
          								@foreach ($students as $student)
										<tr>
										<th >Name:</th>
										<td>{{$student->firstName}} {{$student->lastName}} </td>
										<th>SID :</th>
										<td>{{$student->studentId}}</td>
										</tr>
										<tr>
											<th>Class :</th>
											<td>{{$student->className}} </td>
											<th>Roll</th>
											<td>{{$student->roll}}</td>
										</tr>
										<tr><th>Session :</th>
											<td>{{$student->sessionYear}} </td>
											<th>Section :</th>
											<td>{{$student->sectionName}} </td>
										</tr>
										<tr>
											<th>Group :</th>
											<td>{{$student->group}}</td>
											<th>Shift :</th>
											<td>{{$student->shift}}</td>
										</tr>
										@endforeach
       								 @endif
									</table>
								</div>
							  </div>
							  <div class="col-12">
							  <h3 class="mb-3 text-center">Exam Type -{{$examTypeName}}</h1>
								<hr class="m-2">
							  </div>
						<div class="col-8">
							<div style="overflow-x:auto;">
							<table class="" id="sampleTable" style="width: 100%">
								<thead>
									<tr>
			
										<th rowspan="2">SL</th>
										<th colspan="" rowspan="2" headers="" scope="">subject</th>
										<th colspan="" rowspan="2" headers="" scope="">Fullmark</th>
										<th colspan="2" rowspan="" headers="" scope="" style="padding: 5px;"> Marks Option</th>
									
									</tr>
									<tr>
										
										<th>MCQ</th>
										<th>Written</th>
										<th>Practical</th>
										<th>80%</th>
										<th>CA</th>
										<th>Total</th>
										<th>Point</th>
										<th>Grade</th>
										
									</tr>
								</thead>
								<tbody  id="myresult">
									@foreach ($studentmarks as $mark)
										
									
									<tr>
										<td>1</td>
										<td>{{$mark->Subject->subjectName}}</td>
										<td>100</td>
			
										
										<td>{{$mark->mcq}}</td>
										<td>{{$mark->written}}</td>
										<td>{{$mark->practical}}</td>
										<td>{{$mark->totalEightyPercentMark}}</td>
										<td>{{$mark->ca}}</td>
										<td>{{$mark->total}}</td>
			
										<td>{{$mark->gradePoint}}</td>
										<td>{{$mark->gradeName}}</td>
										
									</tr>
									@endforeach
									{{-- <tr>
										<td>2</td>
										<td>Bangla-2</td>
										<td>100</td>
			
										<td>39</td>
										
										<td>23</td>
										<td>55</td>
										<td>39</td>
										<td>39</td>
										<td>90</td>
			
										<td>5.00</td>
										<td>A+</td>
										
									</tr>
									<tr>
										
										<td colspan="2">Bangla Total</td>
										<td>200</td>
			
										<td> </td>
										
										<td> </td>
										<td>  </td>
										<td> </td>
										<td>39</td>
										<td>90</td>
			
										<td>5.00</td>
										<td>A+</td>
										
									</tr>
									<tr>
										<td>3</td>
										<td>English-1</td>
										<td>100</td>
			
										<td>39</td>
										
										<td>23</td>
										<td>55</td>
										<td>39</td>
										<td>90</td>
			
										<td>5.00</td>
										<td>A+</td>
										
									</tr>
									<tr>
										<td>4</td>
										<td>English-2</td>
										<td>100</td>
			
										<td>39</td>
										
										<td>23</td>
										<td>55</td>
										<td>39</td>
										<td>39</td>
										<td>90</td>
			
										<td>5.00</td>
										<td>A+</td>
										
									</tr>
									<tr>
										
										<td colspan="2">English Total</td>
										<td>200</td>
			
										<td> </td>
										
										<td> </td>
										<td>  </td>
										<td> </td>
										<td>90</td>
			
										<td>5.00</td>
										<td>A+</td>
										
									</tr>
									<tr>
										<td>5</td>
										<td>Mathematics</td>
										<td>100</td>
			
										<td>39</td>
										
										<td>23</td>
										<td>55</td>
										<td>39</td>
										<td>39</td>
										<td>90</td>
			
										<td>5.00</td>
										<td>A+</td>
										
									</tr>
									<tr>
										<td>6</td>
										<td>Religion & moral Education</td>
										<td>100</td>
			
										<td>39</td>
										
										<td>23</td>
										<td>55</td>
										<td>39</td>
										<td>90</td>
										<td>39</td>
										<td>5.00</td>
										<td>A+</td>
										
									</tr>
									<tr>
										<td>7</td>
										<td>Bangladesh & Global studies</td>
										<td>100</td>
			
										<td>39</td>
										
										<td>23</td>
										<td>55</td>
										<td>39</td>
										<td>39</td>
										<td>90</td>
			
										<td>5.00</td>
										<td>A+</td>
										
									</tr>
									<tr>
										<td>8</td>
										<td>physics</td>
										<td>100</td>
			
										<td>39</td>
										
										<td>23</td>
										<td>55</td>
										<td>39</td>
										<td>90</td>
			
										<td>5.00</td>
										<td>A+</td>
										
									</tr>
									<tr>
										<td>9</td>
										<td>chemistry</td>
										<td>100</td>
			
										<td>39</td>
										
										<td>23</td>
										<td>55</td>
										<td>39</td>
										<td>90</td>
										<td>39</td>
										<td>5.00</td>
										<td>A+</td>
										
									</tr>
									<tr>
										<td>10</td>
										<td>ICT</td>
										<td>100</td>
			
										<td>39</td>
										
										<td>23</td>
										<td>55</td>
										<td>39</td>
										<td>90</td>
			
										<td>5.00</td>
										<td>A+</td>
										
									</tr>
									<tr>
										<td>11</td>
										<td>Biology</td>
										<td>100</td>
			
										<td>39</td>
										
										<td>23</td>
										<td>55</td>
										<td>39</td>
										<td>90</td>
			
										<td>5.00</td>
										<td>A+</td>
										
									</tr>
									<tr>
										<td>12</td>
										<td>Higher Math</td>
										<td>100</td>
			
										<td>39</td>
										
										<td>23</td>
										<td>55</td>
										<td>39</td>
										<td>90</td>
			
										<td>5.00</td>
										<td>A+</td>
										
									</tr> --}}
									<tr>
										<td colspan="8" class="text-left">Grand Total/GPA Without 4th  </td>
										
										
										<td>N</td>
			
										<td>N</td>
										<td>N</td>
										
									</tr>
									<tr>
										<td colspan="8" class="text-left">Grand Total/GPA With 4th  </td>
										
										<td>N</td>
			
										<td>N</td>
										<td>N</td>
										
									</tr>
									{{-- <tr>
										<td>13</td>
										<td>Career Education</td>
										<td>100</td>
			
										<td>39</td>
										
										<td>23</td>
										<td>55</td>
										<td>39</td>
										<td>90</td>
			
										<td>5.00</td>
										<td>A+</td>
										
									</tr>
									<tr>
										<td>14</td>
										<td>physical Educatiob & health</td>
										<td>100</td>
			
										<td>39</td>
										
										<td>23</td>
										<td>55</td>
										<td>39</td>
										<td>90</td>
			
										<td>5.00</td>
										<td>A+</td>
										
									</tr> --}}
			
			
								</tbody>
							</table>
							</div>
						</div>
						<div class="col-4">
							<div style="overflow-x:auto">
							<table class="" id="sampleTablegradesInformation" style="width: 100%">
								<thead>
									<tr>
										<th colspan="2" rowspan="" headers="" scope="" style="padding: 5px;"> Grading</th>
										{{-- <th rowspan="2">Letter Grade</th>
										<th rowspan="2">Marks Interval</th>
										<th rowspan="2">Grade point</th> --}}
									   
									</tr>
									<tr>
										{{-- <th colspan="2" rowspan="" headers="" scope=""> Marks Option</th> --}}
										<th>Letter Grade</th>
										<th>Marks Interval</th>
										<th>Grade point</th>
									   
									</tr>
								</thead>
								<tbody id="gradesInformation">
									@if ($grade)
											  @foreach ($grade as $studentgrade)
				
											<tr>
												  <td height="10px" padding="0.00rem">{{ $studentgrade->gradeName }}</td>
												<td height="10px">{{ $studentgrade->maxValue }} - {{ $studentgrade->minValue }}</td>
												<td height="10px">{{ $studentgrade->gradePoint }}</td>
											</tr>
											  
				
											   @endforeach
											@endif
				
								</tbody>
							</table>
						</div>
						</div>
						<div class="col-12">
							<hr>
								<p class="text-center text-bold">Merit Position : </p>
								<hr>
							
						</div>

						<div class="col-3">
							<div class="m-3 text-left">
								
								Total Student:
							</div>
						</div>
						<div class="col-3">
							<div class="m-3 text-left">
								
								Scooling Day:
							</div>
						</div>
						<div class="col-3">   
							<div class="m-3 text-left">
								
								Present :
							</div>
						</div>
						<div class="col-3">   
							<div class="m-3 text-left">
								
								Absent:
							</div>
						</div>
						
						<div class="col-4">
							<div class="m-3 text-center">
								<hr>
								Guardian's Signature
							</div>
						</div>
						<div class="col-4">
							<div class="m-3 text-center">
								<hr>
								Class Teacher's Signature
							</div>
						</div>
						<div class="col-4">   
							<div class="m-3 text-center">
								<hr>
								Head Masters's Signature
							</div>
						</div>
						
					</div>
				</div>
				</div>
			</div>
		</div>

		</div>
<script>
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
        beforePrint: show,          // function called before iframe is filled
        afterPrint: hide,            // function called before iframe is removed
    });
  });
</script>
	
		






    