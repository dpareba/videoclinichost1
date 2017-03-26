<!DOCTYPE html>
<html>
<head>
	<title>ClinicJet | Print</title>
</head>
<body>
	<style>
		div.absolute {
			position: absolute;
			right: 40px;
		} 

		.cc{
			margin-top:8px;
		}
	</style>
	<div class="absolute">Date: {{$visit->created_at->toDateString()}}</div>
	<div>Patient Id: <b>{{$visit->patient->patientcode}}</b></div>
	<div class="absolute">{{$visit->patient->gender}} Age: 
		@if ($visit->patient->dob != "1900-01-01 00:00:00")
		{{$visit->patient->dob->diff(Carbon::now())->format('%y')}}
		@else
		Date of Birth Not Provided
		@endif
	</div>
	<div>Patient Name: <b>{{$visit->patient->name}}</b></div>
	<div class="cc"><b>Chief Complaints: </b>{{$visit->chiefcomplaints}}</div>
	<div class="cc"><b>Findings: </b>{{$visit->examinationfindings}}</div>
	<div class="cc"><b>History: </b>{{$visit->patienthistory}}</div>
	<div class="cc"><b>Diagnosis: </b>{{$visit->diagnosis}}</div>
	<div class="cc"><b>Advise: </b>{{$visit->advise}}</div>
	<div class="absolute"><b>Follow Up Date: </b>
		@if ($visit->isSOS)
		On SOS or With Reports
		@else
		{{$visit->nextvisit}}
		@endif
	</div>
	<img class="cc" src="images/48-128.png" alt="" style="width: 35px; height: 35px;">
	<table>
		<thead>
			<tr>
				<th>Brand Name</th>
				<th>Dose</th>
				<th>Regime</th>
				<th>Duration</th>
				<th>Remarks</th>
			</tr>
		</thead>
		<tbody>
			
		</tbody>
	</table>
	<div class="cc"><b>Recommended Clinical Follow up</b>
		<ul>
			@foreach ($visit->pathologies as $pathology)
			<li>
				{{$pathology->name}}
			</li>
			@endforeach
		</ul>
	</div>
</div>
</body>
</html>